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
                        "station"
                    )

                    $('#station').change ()=>
                        option = `$(this)`.children('option:selected')
                        if $(option).text() == 'Bitte auswählen'
                            @resetMap()
                        else
                            @update(option)

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
            1,
            new CustomXMLLotFormat()
        )

    ##
    # Loads the xml data from given url into the station layer.
    #
    loadStationLayer: (url)->
        if @_map_station_layer?
            @_map.removeLayer(@_map_station_layer)

        @_station_lot_layer = @_map.addPois(
            'Bahnhöfe',
            url,
            1,
            'img/dbstation.png',
            '#C20C0C',
            1,
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
    loadXML: (xslurl, xmlurl, container_id)->
        $.ajax
            "url": xmlurl
            "dataType": "xml"
            "success": (xml)=>
                $.ajax
                    "url": xslurl
                    "dataType": "xml"
                    "success": (xsl)=>
                        @xsltTransform(xml, xsl, container_id)

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
                "table"
            )

new Main()
