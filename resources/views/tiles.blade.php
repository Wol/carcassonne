@extends('master')

@section('content')

    <div class="container-fluid" style="height: 100%;"><div class="row" style="height: 100%;">

            <div class="col-md-9" id="map" style="height: 100%; margin: 0;"></div>

            <div class="col-md-3" style="height: 100%;">

                <div id="nexttileselector">
                    <img id="nexttile" style="margin: 0px auto;" class="img-responsive" src="https://i.imgur.com/zfpMHr8.gif">


                    <div class="row">
                        <div class="col-md-6"><img data-rotation="0" class="img-responsive rotate0 nexttile-place" id="nexttile-place-0" src="https://i.imgur.com/zfpMHr8.gif"></div>
                        <div class="col-md-6"><img data-rotation="90" class="img-responsive rotate90 nexttile-place" id="nexttile-place-90" src="https://i.imgur.com/zfpMHr8.gif"></div>
                        <div class="col-md-6"><img data-rotation="180" class="img-responsive rotate180 nexttile-place" id="nexttile-place-180" src="https://i.imgur.com/zfpMHr8.gif"></div>
                        <div class="col-md-6"><img data-rotation="270" class="img-responsive rotate270 nexttile-place" id="nexttile-place-270" src="https://i.imgur.com/zfpMHr8.gif"></div>
                    </div>
                </div>

            </div>
        </div></div>


    <style>
        .rotate90 {
            transform: rotate(90deg);
        }

        .rotate180 {
            transform: rotate(180deg);
        }

        .rotate270 {
            transform: rotate(270deg);
        }

        .rotate0 {
            transform: rotate(0deg);
        }

        .rotate-disallowed {
            -webkit-filter: grayscale(100%);
        }

        .tile-selected {
            outline: 3px solid green;
        }

        .tileselect-disallowed {
            -webkit-filter: grayscale(100%);
            opacity: 0.5;
        }


    </style>

    <script>

        var nexttileid = 0;

        var map = L.map('map', {crs: L.CRS.Simple}).setView([0, 0], 3);

        var tilelayer = L.tileLayer('https://i.imgur.com/zfpMHr8.gif', {
            minZoom: 3,
            maxZoom: 7,
            maxNativeZoom: 3,
            attribution: 'Carcassonne',
            id: 'carcassonne',
            continuousWorld: true,
            tileSize: 128
        }).addTo(map);


        map.on('click', onMapClick);

        $.get( "/game/{{ $game->id }}/tiles", function( data ) {

            addTiles(data.tiles);
            addMinions(data.minions);

            getNextTile();

        });


        function addMinions(minions){
            for (index = 0; index < minions.length; ++index) {
                var d = minions[index];
                var marker = L.marker([(d.y * 16) - 16, d.x * 16]).addTo(map);
                marker.bindPopup('I am ' + d.type + ' at ' + d.id + ' placed on ' + d.placed_on);
            }
        }


        var pendingelements = [];


        function addTiles(tiles){

            var index;
            for (index = 0; index < tiles.length; ++index) {
                var d = tiles[index];
                var textindex = d.x + ":" + (-d.y);

                if(textindex in tilelayer._tiles){
                    tilelayer._tiles[textindex].src = d.url;

                    $(tilelayer._tiles[textindex]).addClass("rotate" + d.rotation);
                }
            }


        }



        var toplace_x = 0;
        var toplace_y = 0;

        function onMapClick(e) {
            var x = Math.floor(e.latlng.lng / 16);
            var y = Math.floor(e.latlng.lat / 16) + 1;


            $.get( "/tile/" + nexttileid + "/place/" + x + "/" + y, function( data ) {


                clearElements();

                toplace_x = data.x;
                toplace_y = data.y;

                // enable / disable the display of the tiles in different rotations.
                $('#nexttile-place-0').toggleClass('rotate-disallowed', !data.rotations["0"]);
                $('#nexttile-place-90').toggleClass('rotate-disallowed', !data.rotations["90"]);
                $('#nexttile-place-180').toggleClass('rotate-disallowed', !data.rotations["180"]);
                $('#nexttile-place-270').toggleClass('rotate-disallowed', !data.rotations["270"]);


                // Highlight the clicked tile on the map.
                $(".leaflet-tile").removeClass('tile-selected');

                var textindex = data.x + ":" + (-data.y);

                if(textindex in tilelayer._tiles){
                    $(tilelayer._tiles[textindex]).addClass("tile-selected");
                }


            });
        }


        function placeTile(rotate){

            $.get( "/tile/" + nexttileid + "/place/" + toplace_x + "/" + toplace_y + "/" + rotate, function( data ) {

                $(".leaflet-tile").removeClass('tile-selected');

                addTiles(data.tiles);

                console.log("Highlighting elements of:");
                console.log(data.availableelements);
                highlightElements(data.availableelements);

                $('#nexttileselector').addClass("tileselect-disallowed");
                if(data.availableelements.length == 0){
                    getNextTile();
                }

            });

        }


        function highlightElements(elements){
            for (index = 0; index < elements.length; ++index) {
                var d = elements[index];

                console.log("Highlighting element at: " + d.global_x + " , " + d.global_y);
                var marker = L.marker([(d.global_y * 16) - 16, d.global_x * 16]);

                marker.elementID = d.id;
                marker.on('click', placeMinion);

                marker.addTo(map);

                pendingelements.push(marker);
            }
        }

        function placeMinion(e) {

            console.log(e.target.elementID);

            $.get( "/element/" + e.target.elementID + "/placeminion/1", function( data ) {
                clearElements();
                addMinions(data.minions);
                getNextTile();
            });

        }

        function clearElements(){
            for(i=0;i<pendingelements.length;i++) {
                map.removeLayer(pendingelements[i]);
            }

            pendingelements = [];

        }



        function getNextTile(){
            $.get( "/game/{{ $game->id }}/nexttile", function( data ) {

                clearElements();

                $('#nexttileselector').removeClass("tileselect-disallowed");


                $('#nexttile').attr('src', data.nexttile.url);
                $('#nexttile-place-0').attr('src', data.nexttile.url);
                $('#nexttile-place-90').attr('src', data.nexttile.url);
                $('#nexttile-place-180').attr('src', data.nexttile.url);
                $('#nexttile-place-270').attr('src', data.nexttile.url);

                nexttileid = data.nexttile.id;

                $('#nexttile-place-0').toggleClass('rotate-disallowed', true);
                $('#nexttile-place-90').toggleClass('rotate-disallowed', true);
                $('#nexttile-place-180').toggleClass('rotate-disallowed', true);
                $('#nexttile-place-270').toggleClass('rotate-disallowed', true);


            });
        }



        // Handle the click function for placing a tile
        $('.nexttile-place').click(function(ev){
            getNextTile();
            placeTile(ev.target.dataset.rotation);
        });






    </script>

@endsection

