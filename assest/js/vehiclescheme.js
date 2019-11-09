$(window).resize(function () {
    calcularAltoYBordes();
});

function calcularAltoYBordes() {
    var widthEstandar = $("#tblScheme").parent().css("width").replace("px", "");

    var widthPosVehicle = ((parseInt(widthEstandar) * 18) / 100);    
    $(".tblScheme tbody tr td").css("width", widthPosVehicle + "px");

    var heightPosVehicle = ((parseInt(widthEstandar) * 15) / 100);
    $(".posVehicle").css("height", heightPosVehicle + "px");
    $(".tdBlankSpace").css("height", heightPosVehicle + "px");    

    var widthSeparator = ((parseInt(widthPosVehicle) * 60) / 100);
    $(".separator").css("width", widthSeparator + "px");

    var heightBarra = ((parseInt(widthPosVehicle) * 40) / 100);
    $(".barraEje").css("margin-top", heightBarra + "px");
    $(".barraEje").css("width", widthPosVehicle);
        
    var positionHeight = $(".posVehicle:first").css("height").replace("px", "");
    var heightNumberPos = ((parseInt(positionHeight) * 21) / 100);
    $(".numberPosition").css("margin-top", heightNumberPos + "px");
    var fontSize = ((parseInt(positionHeight) * 30) / 100);
    $(".numberPosition").css("font-size", fontSize + "px");

    if ($("#personalizedFunction").length) {
        window[$("#personalizedFunction").val()]();
    }
}

function getVehicleScheme(vehicleCode, idDivContainerScheme, idDivContainerSpare) {
    var result;

    $.ajax({
        type: "POST",
        url: $("#varRutaWebMethod").val(),
        data: "{'vehicleCode':'" + vehicleCode + "'}",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: false,
        success: function (msg) {
            result = drawScheme(msg.d, vehicleCode, idDivContainerScheme, idDivContainerSpare);           
        },
        error: function (msg) {
            alert("Ha ocurrido un error cargando el esquema de llantas del vehículo, intenta mas tarde.");
            result = false;
        }
    });

    return result;
}

function drawScheme(jsonResponse, vehicleCode, idDivContainer, idDivContainerSpare) {
    if (jsonResponse == null) {
        return false;
    }

    var listAxes = jsonResponse.listAxes;    
            
    /*
    antes de iniciar el pintado, se busca el eje con mas posiciones
    y con base a esto sabremos exactamente donde queda el separador
    */
    var countLlantasEje;
    var maxLlantasEje = 0;
    $.each(listAxes, function () {
        countLlantasEje = 0;
        $.each(this.listPos, function () {                        
            if (this.pv !== null) {
                countLlantasEje = parseInt(countLlantasEje) + 1;
            }
        });     

        if (countLlantasEje > maxLlantasEje) {
            maxLlantasEje = countLlantasEje;
        }
    });
    var calculoSeparador = Math.ceil(parseInt(maxLlantasEje) / 2);                    
            
    var contadorPosiciones;
    var axisNumber = 0;

    var tabla = $("<table/>");
    $(tabla).addClass("tblScheme");
    $(tabla).addClass("schemeId_" + jsonResponse.schemeId);

    $(tabla).attr("id", "tblScheme");

    $.each(listAxes, function () {
        var axis = this;

        if (axis.voidsSpacesBefore > 0) {
            for (x = 0; x < axis.voidsSpacesBefore; x++){
                var tr = $("<tr/>");

                if (maxLlantasEje > 1) {
                    for (i = 0; i <= maxLlantasEje; i++) {
                        var td = $("<td/>");
                        $(td).addClass("tdBlankSpace");
                        

                        if (i == calculoSeparador) {
                            if (x == 0 && axisNumber == 0) {
                                $(td).addClass("closeTop");
                            }
                            $(td).addClass("separator");
                        }
                        $(tr).append(td);
                    }
                } else {//solo se dispara en el esquema de llantas de motos
                    var td = $("<td/>");
                    $(td).addClass("tdBlankSpace");
                    $(td).addClass("closeTop");
                    $(td).addClass("separator");
                    $(td).addClass("closeBottom");
                    $(tr).append(td);
                }                        
                        
                $(tabla).append(tr);
            }
        }

        var tr = $("<tr/>");
                
        axisNumber = parseInt(axisNumber) + 1;
        $(tr).addClass("axle");
        $(tr).data("number", axisNumber);
        $(tr).data("isAligned", axis.isAligned);
        $(tr).attr("id", "axle_" + axisNumber);

        contadorPosiciones = 0;

        $.each(axis.listPos, function () {
            var position = this;

            var td = $("<td/>");

            if (position.pv !== null) {
                $(td).attr("id", "tdPos_" + position.pv);
                $(td).data("number", position.pv);
                $(td).addClass("tdPosVehicle");
                                
                var barra = getBarraEje(axis.listPos);
                if (barra != "") {
                    $(td).append(barra);
                }

                var divPos = $("<div/>");
                $(divPos).attr("id", "divPos_" + position.pv);
                $(divPos).addClass("posVehicle");
                $(divPos).data("number", position.pv);
                $(td).append(divPos);
                
                var divNumero = $("<div/>");
                $(divNumero).addClass("numberPosition");
                $(divNumero).html(position.pv);
                                           
                //Si es un esquema de una sola llanta, tampoco se alinean las ruedas hacia un lado
                if (axis.listPos.length != 1) {                        
                    if (contadorPosiciones < calculoSeparador) {
                        $(divPos).addClass("posLeft");
                    } else {
                        $(divPos).addClass("posRight");
                    }
                }                

                if (position.c !== null) {
                    var divTire = getDivTire(position.c, position.pv, false);                    

                    $(divNumero).addClass("white");
                    $(divTire).append(divNumero);
                    
                    $(divPos).append(divTire);

                    //se agregan dos divs mas, uno para info de la llanta y 
                    //otro para agregar botones de accion, ambos estan vacios
                    //y cada proceso que use el esquema se encargara de llenarlos
                    //segun su necesidad.                                

                    var divInfo = $("<div/>");
                    $(divInfo).attr("id", "info_" + position.c.tireCode);
                    $(divInfo).css("display", "none");
                    $(divInfo).addClass("tireInfo");
                    $(td).append(divInfo);

                    var divActions = $("<div/>");
                    $(divActions).attr("id", "actions_" + position.c.tireCode);
                    $(divActions).css("display", "none");
                    $(divActions).addClass("tireActions");
                    $(td).append(divActions);
                    
                    if (contadorPosiciones < calculoSeparador) {
                        $(divInfo).addClass("posLeft");
                        $(divActions).addClass("posLeft");                        
                    } else {
                        $(divInfo).addClass("posRight");
                        $(divActions).addClass("posRight");                        
                    }
                } else {
                    $(divNumero).addClass("black");
                    $(divPos).append(divNumero);
                }
                            
            } else {
                //Si no es una posicion, debe verificarse si es la posicion separador y agregar la clase
                if (contadorPosiciones == calculoSeparador) {
                    $(td).addClass("separator");

                    if (axis.closeTop) {
                        $(td).addClass("closeTop");
                    }

                    if (axis.closeBottom) {
                        $(td).addClass("closeBottom");
                    }
                } else {
                    var barra = getBarraEje(axis.listPos);
                    if (barra != "") {
                        $(td).append(barra);
                    }
                }
            }
            $(tr).append(td);

            contadorPosiciones = parseInt(contadorPosiciones) + 1;
        });
        $(tabla).append(tr);

        if (axis.voidsSpacesAfter > 0) {
            for (x = 0; x < axis.voidsSpacesAfter; x++) {
                var tr = $("<tr/>");

                if (maxLlantasEje > 1) {
                    for (i = 0; i <= maxLlantasEje; i++) {
                        var td = $("<td/>");
                        $(td).addClass("tdBlankSpace");
                        $(tr).append(td);
                    }
                } 
                        
                $(tabla).append(tr);
            }
        }                
    });
    $("#" + idDivContainer).append(tabla);
    
    //Tire Spare
    if (idDivContainerSpare != "") {
        var listRepu = jsonResponse.listRepu;
        if (listRepu != null) {

            var tabla = $("<table/>");
            $(tabla).addClass("tblScheme");
            $(tabla).attr("id", "tblSchemeSpare");
            
            var tr = $("<tr/>");
            $(tr).addClass("spare");
            $(tabla).append(tr);

            $.each(listRepu, function () {
                var repu = this;
                
                var td = $("<td/>");
                $(td).attr("id", "tdPos_" + repu.pv);
                $(td).data("number", repu.pv);
                $(td).addClass("tdPosVehicle");
                $(tr).append(td);
                
                var divPos = $("<div/>");
                $(divPos).attr("id", "divPos_" + repu.pv);
                $(divPos).addClass("posVehicle");
                $(divPos).data("number", repu.pv);
                $(td).append(divPos);

                var divNumero = $("<div/>");
                $(divNumero).addClass("numberPosition");
                $(divNumero).html(repu.pv);

                if (repu.c !== null) {
                    var divTire = getDivTire(repu.c, repu.pv, true);

                    $(divNumero).addClass("white");
                    $(divTire).append(divNumero);

                    $(divPos).append(divTire);

                    //se agregan dos divs mas, uno para info de la llanta y 
                    //otro para agregar botones de accion, ambos estan vacios
                    //y cada proceso que use el esquema se encargara de llenarlos
                    //segun su necesidad.  
                    var divInfo = $("<div/>");
                    $(divInfo).attr("id", "info_" + repu.c.tireCode);
                    $(divInfo).css("display", "none");
                    $(divInfo).addClass("tireInfo");
                    $(td).append(divInfo);

                    var divActions = $("<div/>");
                    $(divActions).attr("id", "actions_" + repu.c.tireCode);
                    $(divActions).css("display", "none");
                    $(divActions).addClass("tireActions");
                    $(td).append(divActions);
                } else {
                    $(divNumero).addClass("black");
                    $(divPos).append(divNumero);
                }
            });
        }

        $("#" + idDivContainerSpare).append(tabla);
    }

    calcularAltoYBordes();

    if ($(".schemeId_12").length) {
        $(".tireInfo").removeClass("posLeft");
        $(".tireActions").removeClass("posLeft");        
    }

    if ($(".schemeId_14").length) {
        var td = $("#axle_1").next().find("td:nth-child(2)");
        $(td).addClass("closeTop");

        $("#divPos_1").removeClass("posRight");
        $("#info_fh1").removeClass("posRight");
        $("#actions_fh1").removeClass("posRight");

        $("#axle_1").find(".barraEje").remove();
    }    

    return true;    
}

function getDivTire(tireInfo, position, isSpare) {
    var divTire = $("<div/>");

    $(divTire).addClass("tire");
    $(divTire).attr("id", tireInfo.tireCode);
    $(divTire).data("tireId", tireInfo.tireId);
    $(divTire).data("tireCode", tireInfo.tireCode);
    $(divTire).data("tire", tireInfo.tire);
    $(divTire).data("category", tireInfo.category);
    $(divTire).data("type", tireInfo.type);
    $(divTire).data("number", position);
    
    $(divTire).data("lastDatePressure", tireInfo.lastDatePressure);
    $(divTire).data("lastPressure", tireInfo.lastPressure);
    $(divTire).data("lastDateLowestDepth", tireInfo.lastDateLowestDepth);
    $(divTire).data("lastLowestDepth", tireInfo.lastLowestDepth);

    $(divTire).data("isMaximumPressure", tireInfo.isMaximumPressure);
    $(divTire).data("isMinimumPressure", tireInfo.isMinimumPressure);
    $(divTire).data("isMinimumDepthNear", tireInfo.isMinimumDepthNear);
    $(divTire).data("wasMinimumDepthOvercome", tireInfo.wasMinimumDepthOvercome);

    $(divTire).data("isSpare", isSpare);

    return divTire;
}

function getBarraEje(listPos) {
    var barra = "";
    if (listPos.length == 3) {
        if (listPos[1].c == null) {
            barra = $("<hr/>");
            $(barra).addClass("barraEje");
        }
    } else {
        //se verifica si es un esquema de una sola llanta para omitar la barra
        if (listPos.length != 1) {
            barra = $("<hr/>");
            $(barra).addClass("barraEje");
        }
    }
    return barra;
}