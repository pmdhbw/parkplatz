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
                "Öffnungszeiten" : "parkraumOeffnungszeiten"
                "Betreiber" : "parkraumBetreiber"
                "Zahlung" : "zahlungMedien"
                "Bemerkung" : "parkraumBemerkung"
                "Preis für 30 Minuten" : "tarif30Min"
                "Preis für 1 Stunde" : "tarif1Std" 
                "Preis für 1 Tag" : "tarif1Tag"
                "Preis für 1 Woche" : "tarif1Woche"

            for label,xml_key of map
                child = $(lot).children(xml_key)
                if child.length > 0 && !$(child).is(':empty') 
                    attributes[label] = $(child).text()

            attributes["Name"] = "Parkplatz Nr. #{$(lot).children('parkraumKennung').text()}"

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
                "Name": "station"
                "Straße" : "street"
                "PLZ" : "plz"
                "Stadt"  : "cityTitle"
            
            for label,xml_key of map
                child = $(station).children(xml_key)
                if child.length > 0 && !$(child).is(':empty')
                    attributes[label] = $(child).text()

            marker = new OpenLayers.Feature.Vector(geom, attributes)
            features.push(marker)

        features

