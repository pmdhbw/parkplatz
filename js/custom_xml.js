// Generated by CoffeeScript 1.10.0
(function() {
  window.CustomXMLLotFormat = OpenLayers.Class(OpenLayers.Format.XML, {
    read: function(doc) {
      var attributes, child, features, geom, i, label, lat, len, lon, lot, map, marker, nr, ref, text, xml_key;
      if (typeof doc === "string") {
        doc = OpenLayers.Format.XML.prototype.read.apply(this, [data]);
      }
      features = [];
      ref = $(doc).find("lot");
      for (i = 0, len = ref.length; i < len; i++) {
        lot = ref[i];
        lat = $(lot).children('parkraumGeoLatitude').text();
        lon = $(lot).children('parkraumGeoLongitude').text();
        geom = new OpenLayers.Geometry.Point(lon, lat);
        attributes = {};
        map = {
          "Nr": "parkraumKennung",
          "Parkart": "parkraumParkart",
          "Zufahrt": "parkraumZufahrt",
          "Entfernung": "parkraumEntfernung",
          "Stellplätze": "parkraumStellplaetze",
          "Freie Stellplätze": "category",
          "Öffnungszeiten": "parkraumOeffnungszeiten",
          "Betreiber": "parkraumBetreiber",
          "Zahlung": "zahlungMedien",
          "Bemerkung": "parkraumBemerkung",
          "Preis für 30 Minuten": "tarif30Min",
          "Preis für 1 Stunde": "tarif1Std",
          "Preis für 1 Tag": "tarif1Tag",
          "Preis für 1 Woche": "tarif1Woche"
        };
        nr = $(lot).children('parkraumKennung').text();
        attributes["Name"] = "Parkplatz Nr. " + nr;
        for (label in map) {
          xml_key = map[label];
          child = $(lot).children(xml_key);
          if (child.length > 0 && !$(child).is(':empty')) {
            attributes[label] = $(child).text();
          }
        }
        if (attributes["Freie Stellplätze"] != null) {
          text = "";
          switch (attributes["Freie Stellplätze"]) {
            case "1":
              text = '1 - 10';
              break;
            case "2":
              text = '11 - 30';
              break;
            case "3":
              text = '31 - 50';
              break;
            case "4":
              text = '51+';
          }
          attributes['Freie Stellplätze'] = text;
        }
        marker = new OpenLayers.Feature.Vector(geom, attributes);
        features.push(marker);
      }
      return features;
    }
  });

  window.CustomXMLDBStationFormat = OpenLayers.Class(OpenLayers.Format.XML, {
    read: function(doc) {
      var attributes, child, features, geom, i, label, lat, len, lon, map, marker, name, ref, station, xml_key;
      if (typeof doc === "string") {
        doc = OpenLayers.Format.XML.prototype.read.apply(this, [data]);
      }
      features = [];
      ref = $(doc).find("dbstation");
      for (i = 0, len = ref.length; i < len; i++) {
        station = ref[i];
        lat = $(station).children('stationGeoLatitude').text();
        lon = $(station).children('stationGeoLongitude').text();
        geom = new OpenLayers.Geometry.Point(lon, lat);
        attributes = {};
        map = {
          "Straße": "street",
          "PLZ": "plz",
          "Stadt": "cityTitle",
          "&nbsp;": ""
        };
        name = $(station).children('station').text();
        attributes["Name"] = "Bahnhof " + name;
        for (label in map) {
          xml_key = map[label];
          child = $(station).children(xml_key);
          if (child.length > 0 && !$(child).is(':empty')) {
            attributes[label] = $(child).text();
          }
        }
        attributes["<button\n    data-longitude=\"" + lon + "\"\n    data-latitude=\"" + lat + "\"\n    class=\"station-btn btn btn-danger btn-block btn-lg\"\n>\n    <i class=\"fui-info-circle\"></i>\n    &nbsp;Parkplätze in der Nähe\n</button>"] = '';
        marker = new OpenLayers.Feature.Vector(geom, attributes);
        features.push(marker);
      }
      return features;
    }
  });

}).call(this);
