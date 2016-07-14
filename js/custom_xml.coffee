window.CustomXMLLotFormat = OpenLayers.Class OpenLayers.Format.XML,
    read: (doc) ->
        # We're going to read XML
        if typeof doc == "string"
            doc = OpenLayers.Format.XML.prototype.read.apply @, [data]

        features = []

        for lot in $(doc).find("lot")
            lat = $(lot).children('parkraumGeoLatitude').text()
            lon = $(lot).children('parkraumGeoLongitude').text()
            geom = new OpenLayers.Geometry.Point(lon, lat) 
            
            attributes = {}
            map =
                "Nr" : "parkraumKennung"
                "Parkart"  : "parkraumParkart"
                "Zufahrt" : "parkraumZufahrt"
                "Entfernung" : "parkraumEntfernung"
                "Stellplätze" : "parkraumStellplaetze"
                "Freie Stellplätze" : "category"
                "Öffnungszeiten" : "parkraumOeffnungszeiten"
                "Betreiber" : "parkraumBetreiber"
                "Zahlung" : "zahlungMedien"
                "Bemerkung" : "parkraumBemerkung"
                "Preis für 30 Minuten" : "tarif30Min"
                "Preis für 1 Stunde" : "tarif1Std" 
                "Preis für 1 Tag" : "tarif1Tag"
                "Preis für 1 Woche" : "tarif1Woche"

            nr = $(lot).children('parkraumKennung').text() 
            attributes["Name"] = "Parkplatz Nr. #{nr}"

            for label,xml_key of map
                child = $(lot).children(xml_key)
                if child.length > 0 && !$(child).is(':empty') 
                    attributes[label] = $(child).text()

            if attributes["Freie Stellplätze"]?
                text=""
                switch attributes["Freie Stellplätze"]
                    when "1" then text='1 - 10'
                    when "2" then text='11 - 30'
                    when "3" then text='31 - 50'
                    when "4" then text='51+'
                attributes['Freie Stellplätze'] = text

            marker = new OpenLayers.Feature.Vector(geom, attributes)
            features.push(marker)

        features

window.CustomXMLDBStationFormat = OpenLayers.Class OpenLayers.Format.XML,
    read: (doc) ->
        # We're going to read XML
        if typeof doc == "string"
            doc = OpenLayers.Format.XML.prototype.read.apply @, [data]

        features = []

        for station in $(doc).find("dbstation")
            lat = $(station).children('stationGeoLatitude').text()
            lon = $(station).children('stationGeoLongitude').text()
            geom = new OpenLayers.Geometry.Point(lon, lat) 
            
            attributes = {}
            map =
                "Straße" : "street"
                "PLZ" : "plz"
                "Stadt"  : "cityTitle"
                "&nbsp;" : ""

            name = $(station).children('station').text() 
            attributes["Name"] = "Bahnhof #{name}"
            
            for label,xml_key of map
                child = $(station).children(xml_key)
                if child.length > 0 && !$(child).is(':empty')
                    attributes[label] = $(child).text()

            attributes["""
                <button
                    data-longitude="#{lon}"
                    data-latitude="#{lat}"
                    class="station-btn btn btn-danger btn-block btn-lg"
                >
                    <i class="fui-info-circle"></i>
                    &nbsp;Parkplätze in der Nähe
                </button>
            """] = ''

            marker = new OpenLayers.Feature.Vector(geom, attributes)
            features.push(marker)

        features

