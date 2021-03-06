var markers = new L.FeatureGroup();

$(document).ready(function () {
    var map = L.map('map').setView([48.76375572, 31.62963867], 6);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var points = $("#map").data();

    for (var point in points.items) {
        if (points.items.hasOwnProperty(point)) {
            L.marker([points.items[point].latitude, points.items[point].longitude]).addTo(map);
        }
    }

    function formatDate(dateObject) {
        var d = new Date(dateObject);
        var day = d.getDate();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();

        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }
        var date = day + "." + month + "." + year;

        return date;
    }

    /* Clear page from all items and markers on map */
    function clearPage() {
        markers.clearLayers();
        $('#items').empty();
    }

    var categories;
    var categoriesId = [];
    var popupTextArray = [];
    var checkedCategory = false;
    $.ajax({
        url: Routing.generate('get_categories'),
        type: 'get',
        dataType: 'JSON',
        success: function (data) {
            categories = new Object(data);
            $.ajax({
                url: Routing.generate('show_found_points'),
                type: 'get',
                dataType: 'JSON',
                success: function (data) {

                    $('.btn-group').on('change', function() {
                        categoriesId = [];
                        clearPage();
                        checkedCategory = false;
                        $('.btn-group input:checked').each(function(id, label) {
                            categoriesId.push($(label).data('categoryId'));
                            clearPage();
                            for (var i = 0; i < data.length; i++) {
                                if ((categoriesId.indexOf(data[i].categoryId)) >= 0) {
                                    checkedCategory = true;
                                    var cat = categories[data[i].categoryId];
                                    if (cat['imageName'] !== null) {
                                        var icon = L.icon({
                                            iconUrl: cat['imageName'], iconSize: [32, 32]
                                        });
                                        marker = L.marker([data[i].latitude, data[i].longitude], {icon: icon});
                                    } else {
                                        marker = L.marker([data[i].latitude, data[i].longitude]);
                                    }
                                    $('#items').append('<li><a id="item_' + data[i].itemId + '" href="' + data[i].link +'" >' + data[i].title + '</a></li>');

                                    var popupText = "<div><h6 align='center' style='margin-bottom: 0'><b>"
                                        + cat.title
                                        + "</b></h6></br>"
                                        + "<h3 style='margin: 0' align='center'><a href='"
                                        + data[i].link
                                        + "'>"
                                        + data[i].title
                                        + "</a></h3></br>"
                                        + "<p style='margin-top: 0' align='right'>Added: "
                                        + formatDate(data[i].date.date)
                                        + "</p></div>";

                                    marker.bindPopup(popupText);

                                    if (data[i].latitude === null) {
                                        continue;
                                    }
                                    markers.addLayer(marker);
                                }
                            }
                        });

                    });

                }
            });
        }
    });

    map.addLayer(markers);
});
