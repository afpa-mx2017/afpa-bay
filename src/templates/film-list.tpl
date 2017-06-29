    <style>
        
        .film-list{
            list-style-type: none;
            margin:0;
            padding:0;
        }
        .film-list li{
            border:1px solid grey;
            margin:0.5em;
            padding:1em;
            display:inline-block;
            width:20%;
        }

        .film-list li img{
            max-height: 300px;
            width: 100%;
            height: auto;
        }

        @media screen and (max-width: 640px) {
         .film-list li{
             width:95%;
             margin:0;
             padding:0.5em 0.5em;
         }
        }

        .film-list-actions {
            border:1px dashed grey;
        }
        .film-list-actions > * {
            display:inline-block;
        }
        
        .film-list-actions a {
            text-align: right;
        }
        
    </style>
    
    <header>
        <h2>Liste des films</h2>
       
        <div class="film-list-actions">
             <form class="search" method="get" action="/film">
                <input type="text" name="recherche" value="{{recherche}}"/>
                <input type="submit" name="ok" value="rechercher"/>
            </form>
            <div>
                <a class="right" href="/film/new">ajouter un film</a>
            </div>
        </div>
        
      
    </header>
    <div>
        <em>{{films.length}} film(s) trouvé(s)</em>
        <ul class="film-list">
        {{#films}}

            <li film-id="{{id}}"><div><img src="{{thumbnail}}"/><h3>{{titre}}</h3><p class="auteur">réalisé par:{{auteur}}</p>
            <p>Genre: {{genre}}</p>
            <a class="bookmark {{#vu}}seen{{/vu}}" href="javascript:void();"></a>
          
            </div></li>
        
       {{/films}}
        </ul>
    
    </div>
    <style>

        
        .film-list a.bookmark:before {
            content: "\2606";
        }
        .film-list a.seen:before {
          content: "\2605";
        }
        
    </style>
    <script>
        
        function toggleSeen(e){
            var that = this;
            var filmId = this.parentNode.parentNode.getAttribute('film-id'); 
            var req = new XMLHttpRequest();
            var data = new FormData();
            data.append('seen',!this.classList.contains('seen') );
            req.open('POST', '/film/' + filmId, true);
            req.onload = function () {
              if(this.status === 200){ //response ok
                 that.classList.toggle('seen');
              }else if (this.status===403){
                  alert('vous devez être connecté pour pouvoir effectuer cette action ');
                  
              }else{
                  alert(this.responseText);
              }
                
            };
            req.send(data);
            
            
            
        }
        
        var $as = document.querySelectorAll('.film-list a.bookmark');
        for (var i = 0; i < $as.length; i++) {
            $as[i].onclick = toggleSeen;
        }
        
    </script>
