class window.Main
    constructor: ()->
        #  Map object that renders and controls the map on the page.
        @_map = undefined

        # The layer on to which the lots are drawn.
        @_map_lot_layer = undefined

        # The layer on to which the stations are drawn.
        @_map_station_layer = undefined

        # The layer on to which to draw the search area.
        @_map_search_area_layer = undefined

        $(document).ready ()=>
            # Asynchronus request to start app.php/init.
            # if database is old it will be refreshed here,
            # hopefully before document ready is called
            # otherwise we rely on database integrity
            $.ajax
                'url': "parkplatz/web/app.php/init"

            # Load global config.
            $.ajax
                'url': 'config.json'
                'dataType': 'json'
                'success': (config)=>
                    window.Config = config;

                    @styleUI()
                    @_map = new Map("map")
                    @resetMap()

                    @loadXML(
                        "XSLT_Stations.xsl",
                        "parkplatz/web/app.php/dbstation",
                        "station",
                        ()->
                            $('#station').select2()
                    )

                    $('#station').change ()=>
                        option = `$(this)`.children('option:selected')
                        if $(option).text() == 'Bitte auswählen'
                            @resetMap()
                        else
                            @update(option)

                    $('#radius').change ()=>
                        @update('#station option:selected')

                    $('.filter').change ()=>
                        @applyFiltersOnList()
                        @applyFiltersOnMap()

                    $(document).on 'markerClicked', (e)=>
                        e.modal.find('.station-btn').click ()=>
                            e.modal.modal('hide')
                            `_this.update(this)`
        

    ##
    # Init JS generated UI elements.
    # We use JS to style some form elements like selects and check boxes
    # because this can't be really done with CSS.
    ##
    styleUI: ()->
        # selects
        $('[data-toggle="select"]').select2()

        # check boxes
        $('[data-toggle="checkbox"]').radiocheck()
        $('[data-toggle="radio"]').radiocheck()
        $('[data-toggle="switch"]').bootstrapSwitch()

    ##
    # Set map to intial state.
    #
    resetMap: ()->
        $.ajax
            'url': 'deutschland.wkt'
            'dataType': 'text'
            'success': (wkt)=>
                @setSearchAreaLayer(wkt)

                poi_url = 'parkplatz/web/app.php/dbstation'
                @loadLotLayer(poi_url)
                @loadStationLayer(poi_url)

                @_map.zoomToExtent(@_search_area_layer)

    ##
    # Loads the xml data from given url into the lot layer.
    #
    loadLotLayer: (url)->
        if @_map_lot_layer?
            @_map.removeLayer(@_map_lot_layer)

        @_map_lot_layer = @_map.addPois(
            'Parkplätze',
            url,
            2,
            'img/parkinggarage.png',
            '#003399',
            true,
            new CustomXMLLotFormat(),
            false
        )

        @applyFiltersOnMap()

    ##
    # Loads the xml data from given url into the station layer.
    #
    loadStationLayer: (url)->
        if @_map_station_layer?
            @_map.removeLayer(@_map_station_layer)

        @_map_station_layer = @_map.addPois(
            'Bahnhöfe',
            url,
            1,
            'img/dbstation.png',
            '#C20C0C',
            true,
            new CustomXMLDBStationFormat()
        )

    ##
    # Set the search are layer to the given value.
    ##
    setSearchAreaLayer: (wkt)->
        if @_search_area_layer?
            @_map.removeLayer(@_search_area_layer)

        @_search_area_layer = @_map.addShapes(
            'Suchbereich',
            [wkt]
        )

    ##
    # Load given xml and transform it using xsl and write the result into given container.
    ##
    loadXML: (xslurl, xmlurl, container_id, callback)->
        $.ajax
            "url": xmlurl
            "dataType": "xml"
            "success": (xml)=>
                $.ajax
                    "url": xslurl
                    "dataType": "xml"
                    "success": (xsl)=>
                        @xsltTransform(xml, xsl, container_id)
                        if callback?
                            callback()
                            return

    ##
    # Transform given xml with given xsl document and write the result into given container.
    ##
    xsltTransform: (xml, xsl, container_id)->
        # Clear target.
        $("##{container_id}").empty()

        # IE
        if window.ActiveXObject || ("ActiveXObject" of window)
            content = xml.TransformNode(xsl)
        # Chrome, Firefox, ...
        else if document.implementation && document.implementation.createDocument
            xslt_p = new XSLTProcessor()
            xslt_p.importStylesheet(xsl)
            result_d = xslt_p.transformToFragment(xml, document)
            $("##{container_id}").append(result_d)
        else
            alert ('Browser wird nicht unterstützt')

    ##
    # Update map and list below map according to coordinates in given element.
    ##
    update: (element)->
        lon = parseFloat($(element).attr('data-longitude'))
        lat = parseFloat($(element).attr('data-latitude'))
        radius = parseInt($('#radius').val())

        $("#station option[data-longitude='#{lon}'][data-latitude='#{lat}']") \
        .attr('selected','selected')
        $('#station').select2()

        if lon && lat && radius
            # Url to xml that contains info about stations.
            url = "parkplatz/web/app.php/dbrange?radius=#{radius}&long=#{lon}&lat=#{lat}" 

            # Update map.
            wkt = "CIRCLE (#{lon} #{lat} #{radius})"
            @loadLotLayer(url)
            @setSearchAreaLayer(wkt)
            @_map.zoomToExtent(@_search_area_layer)

            # Update list.
            @loadXML(
                "XSLT_Lots.xsl",
                url,
                "table",
                ()=>
                    @applyFiltersOnList()
            )
    
    ##
    # Shows and hides rows on lot list according to selected filters.
    ##
    applyFiltersOnList: ()->
        freeval = $("#free").val()
        payval = $("#pay").val()
        housechecked = $('#house').prop('checked')
        openchecked = $('#open').prop('checked')
        freecheked = $('#freeofcharge').prop('checked')

        $('.lots-list .list-group-item').each ()=>
            `$(this)`.show()

            # Number of free parking spaces is given as a category value.
            category = `$(this)`.attr('data-category')
            if freeval != 0 && category? && parseInt(freeval) > category
                `$(this)`.show()

            # Payment method.
            zahlungMedien = `$(this)`.attr('data-zahlungMedien').toLowerCase()
            if payval == "1" && (zahlungMedien.indexOf("ec-karte") == -1)
                `$(this)`.hide()
            else if payval == "2" && (zahlungMedien.indexOf("kreditkarte") == -1)
                `$(this)`.hide()
            else if payval == "3" && zahlungMedien.indexOf("münzen")  == -1 && zahlungMedien.indexOf("bargeld")  == -1
                `$(this)`.hide()

            # Parking type.
            parkraumParkart = `$(this)`.attr("data-parkraumParkart").toLowerCase()
            if housechecked && parkraumParkart != "parkhaus" && parkraumParkart != "tiefgarage"
                `$(this)`.hide()

            # Opening hours.
            opening = `$(this)`.attr("data-parkraumoeffnungszeiten")
            if openchecked && opening? && !@isOpen(opening)
                `$(this)`.hide()

    ##
    # Shows and hides markers on map according to selected filters.
    ##
    applyFiltersOnMap: ()->
        freeval = $("#free").val()
        payval = $("#pay").val()
        housechecked = $('#house').prop('checked')
        openchecked = $('#open').prop('checked')
        freecheked = $('#freeofcharge').prop('checked')

        for feature in @_map_lot_layer.features
            if feature.style?
                delete feature.style

            # Number of free parking spaces is given as a category value.
            if feature.attributes["Freie Stellplätze"]?
                min_free = parseInt(feature.attributes["Freie Stellplätze"])
                switch freeval
                    when "1"
                        if min_free < 1 then feature.style = {"display": "none"}
                    when "2"
                        if min_free <= 10 then feature.style = {"display": "none"}
                    when "3"
                        if min_free <= 30 then feature.style = {"display": "none"}

            # Payment method.
            if feature.attributes["Zahlung"]?
                zahlungMedien = feature.attributes["Zahlung"].toLowerCase()
                if payval == "1" && (zahlungMedien.indexOf("ec-karte") == -1)
                    feature.style = {"display": "none"}
                else if payval == "2" && (zahlungMedien.indexOf("kreditkarte") == -1)
                    feature.style = {"display": "none"}
                else if payval == "3" && zahlungMedien.indexOf("münzen")  == -1 && zahlungMedien.indexOf("bargeld")  == -1
                    feature.style = {"display": "none"}
            else if payval != "0"
                feature.style = {"display": "none"}

            # Parking type.
            if feature.attributes["Parkart"]?
                parkraumParkart = feature.attributes["Parkart"].toLowerCase()
                if housechecked && parkraumParkart != "parkhaus" && parkraumParkart != "tiefgarage"
                    feature.style = {"display": "none"}
            else if housechecked
                feature.style = {"display": "none"}

            # Opening hours.
            if openchecked && !@isOpen(feature.attributes["Öffnungszeiten"])
                feature.style = {"display": "none"}

        @_map_lot_layer.redraw()

    ##
    # Checks if according to given opening hours the lot is open.
    #
    isOpen: (opening)->
        firstsplit = opening.split(",")
        # time is given from Mo to Sun
        if firstsplit.length == 1
            times = firstsplit[0].split(".")
            time = times[0].split(" - ")
            start = time[0].split(":")
            end = time[1].split(":")
            end[1] = end[1].split(" ")[0]
            jetzt = new Date()
            open = new Date(jetzt.getFullYear(), jetzt.getMonth(), jetzt.getDate(),start[0], start[1], "0")
            close = new Date(jetzt.getFullYear(), jetzt.getMonth(), jetzt.getDate(), end[0], end[1], "0")
            if !(jetzt.getTime() > open.getTime() && jetzt.getTime() < close.getTime())
                return false

        # Different times for weekend and working days.
        else if firstsplit.length == 3
            mo = firstsplit[0].split(": ")
            mot = mo[1].split(" - ")
            mostart = mot[0].split(":")
            moend = mot[1].split(":")
            moend[1] = moend[1].split(" ")[0]
            sa = firstsplit[1].split(": ")
            sat = sa[1].split(" - ")
            sastart = sat[0].split(":")
            saend = sat[1].split(":")
            saend[1] = saend[1].split(" ")[0]
            jetzt = new Date()
            if jetzt.getDay == 0
                return false
            else if jetzt.getDay == 6
                open = new Date(jetzt.getFullYear(), jetzt.getMonth(), jetzt.getDate(), sastart[0], sastart[1], "0")
                close = new Date(jetzt.getFullYear(), jetzt.getMonth(),jetzt.getDate(), saend[0], saend[1], "0")
                if !(jetzt.getTime > open.getTime() && jetzt.getTime() < close.getTime())
                    return false
                else
                    open = new Date(jetzt.getFullYear(), jetzt.getMonth(), jetzt.getDate(), mostart[0], mostart[1], "0")
                    close = new Date(jetzt.getFullYear(), jetzt.getMonth(), jetzt.getDate(), moend[0], moend[1], "0")
                    if (jetzt < open) || (jetzt > close)
                         return false
        true

new Main()
