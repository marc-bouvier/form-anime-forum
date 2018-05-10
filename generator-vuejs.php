<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Otaku Family - Fiches</title>
    <link rel="stylesheet" type="text/css" href="/uploads/ressources/generator.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i">
    <link rel="shortcut icon" href="favicon.ico">
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>

</head>

<body>

<div id="app">

<!-- Loader -->

<div class="animeCode">
    <?php
    include 'icotaku-loader.php';
    
		if(isset($_POST['url']) && !empty($_POST['url'])){
      $infos = getIcotakuInfos($_POST['url']);
		}
		?>
    <h2>Loader</h2>
    <form action="" method="POST" class="form">
        <input type="text" name="url" placeholder="URL Icotaku">
        <button class="btnCopy">Charger les infos</button>
    </form>
</div>

<hr/>
<hr/>

<!-- Form -->

<div id="animeData">
    <div id="formRender">
        <h2>Formulaire de fiche d'animé</h2>
        <div id="form">
            <table class="form">
                <tbody>
                <tr>
                    <th>
                        <label>Nom de l'anime</label>
                    </th>
                    <td>
                        <input type="text" v-model="title" />
                    </td>
                </tr>

                <tr>
                    <th>
                        <label>Image de l'anime</label>
                    </th>
                    <td>
                        <input type="text" v-model="picture" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label>Origine</label>
                    </th>
                    <td>
                        <select type="text" v-model="origin">
                            <option value="Indisponible">Faites un choix</option>
                            <option value="Autre">Autre</option>
                            <option value="Comic">Comic</option>
                            <option value="Drama">Drama</option>
                            <option value="Jeu vidéo">Jeu vidéo</option>
                            <option value="Light novel">Light novel</option>
                            <option value="Manga">Manga</option>
                            <option value="Multimédias">Multimédias</option>
                            <option value="Roman">Roman</option>
                            <option value="Œuvre originale">Œuvre originale</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label>Catégorie</label>
                    </th>
                    <td>
                        <select v-model="category">
                            <option value="Indisponible">Faites un choix</option>
                            <option value="TV">TV</option>
                            <option value="TV Spécial">TV Spécial</option>
                            <option value="OAV">OAV</option>
                            <option value="Film">Film</option>
                            <option value="ONA">ONA</option>
                            <option value="OAD">OAD</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label>Genre(s)</label>
                    </th>
                    <td>
                        <input type="text" v-model="genre" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label>Thème(s)</label>
                    </th>
                    <td>
                        <input type="text" v-model="theme" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label>Public visé</label>
                    </th>
                    <td>
                        <select v-model="targetedAudience">
                            <option value="Indisponible">Faites un choix</option>
                            <option value="Seinen">Seinen</option>
                            <option value="Shōnen">Shōnen</option>
                            <option value="Josei">Josei</option>
                            <option value="Shōjo">Shōjo</option>
                            <option value="Kodomo">Kodomo</option>
                            <option value="Yaoi">Yaoi</option>
                            <option value="Yuri">Yuri</option>
                            <option value="18+ - Hentai">Hentai</option>
                            <option value="Tout public">Tout public</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label>Nombre d'épisodes</label>
                    </th>
                    <td>
                        <input type="number" v-model="episodeNumber" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label>Durée d'un épisode (min)</label>
                    </th>
                    <td>
                        <input type="number" v-model="episodeDuration" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label>Saison</label>
                    </th>
                    <td>
                        <select v-model="firstDiffusionQuarter">
                            <option value="Indisponible">Faites un choix</option>
                            <option value="Printemps">Printemps</option>
                            <option value="Été">Été</option>
                            <option value="Automne">Automne</option>
                            <option value="Hiver">Hiver</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label>Année de production</label>
                    </th>
                    <td>
                        <input type="number" v-model="yearProduction" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label>Diffusion</label>
                    </th>

                    <td class="diff">
                        <select v-model="diffusionStatus">
                            <option value="Indisponible">Faites un choix</option>
                            <option value="En cours">En cours</option>
                            <option value="Terminée">Terminé</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label>Studio(s) d'animation</label>
                    </th>
                    <td>
                        <input type="text" v-model="animationStudio" />
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="formhistory">
                <tbody>
                <tr>
                    <th>
                        <label>Histoire</label>
                    </th>
                    <td>
                        <textarea v-model="summary"></textarea>
                    </td>
                </tr>
                </tbody>
            </table>
            <table v-for="season in saisons" class="formSeason">
                <tbody>
                <tr >
                    <th>Saison</th>
                    <td>
                        <input v-model="season.label" />
                    </td>
                </tr>
                <tr>
                    <th>Score</th>
                    <td>
                        <input type="number" step="any" placeholder="MyAnimeList Score : 0,00" v-model="season.score" />
                    </td>
                </tr>
                <tr>
                    <th>LD</th>
                    <td>
                        <input placeholder="ID du dossier Uptobox" v-model="season.linkLowDef" />
                    </td>
                </tr>
                <tr>
                    <th>720p</th>
                    <td>
                        <input placeholder="ID du dossier Uptobox" v-model="season.link720p" />
                    </td>
                </tr>
                <tr>
                    <th>1080p</th>
                    <td>
                        <input placeholder="ID du dossier Uptobox" v-model="season.link1080p" />
                    </td>
                </tr>
                <tr>
                    <th>Premium</th>
                    <td>
                        <input placeholder="Lien direct Uptobox" v-model="season.linkPremium" />
                    </td>
                </tr>
                </tbody>
            </table>
            <br/>

            <button @click="addSeason">+</button>
            <button @click="removeSeason">-</button>
        </div>

    </div>
    <!-- Preview -->

    <div id="previewRender">
        <h2>Visualisation</h2>
        <div id="preview">
            <div id="complements">
                <p class="affiche">
                    <img v-bind:src="picture" v-bind:alt="title" />
                </p>
            </div>

            <div id="info">
                <p>
            <span>
              <b>Titre alternatif</b> :{{title}}
            </span>
                    <br/>
                    <br/>
                    <b>Origine</b> : {{formatValue(origin)}}
                    <br/>
                    <b>Catégorie</b> : {{formatValue(category)}}
                    <br/>
                    <b>Genre(s)</b> : {{formatValue(genre)}}
                    <element data-link="genre||'Indisponible'"></element>
                    <br/>
                    <b>Théme(s)</b> : {{formatValue(theme)}}
                    <element data-link="theme||'Indisponible'"></element>
                    <br/>
                    <b>Public visé</b> : {{formatValue(targetedAudience)}}
                    <element data-link="targetedAudience||'Indisponible'"></element>
                    <br/>
                    <b>Nombre d'épisode</b> : {{formatValue(episodeNumber)}}
                    <element data-link="episodeNumber||'Indisponible'"></element>
                    <br/>
                    <b>Durée d'un épisode</b> : {{formatDurationMins(episodeDuration)}}
                    <element data-link="episodeDuration||'Indisponible'"></element>
                    <element data-link="visible{:episodeDuration}"> mins</element>
                    <br/>
                    <b>Saison</b> : {{formatValue(firstDiffusionQuarter)}}
                    <element data-link="firstDiffusionQuarter||'Indisponible'"></element>
                    <br/>
                    <b>Année de production</b> : {{formatValue(yearProduction)}}
                    <element data-link="yearProduction||'Indisponible'"></element>
                    <br/>
                    <b>Diffusion</b> : {{formatValue(diffusionStatus)}}
                    <element data-link="diffusionStatus||'Indisponible'"></element>
                    <br/>
                    <b>Studio(s) d'animation</b> : {{formatValue(animationStudio)}}
                    <element data-link="animationStudio||'Indisponible'"></element>
                    <br/>
                    <br/>
                    <b>Histoire</b> : {{formatValue(summary)}}
                    <element data-link="summary||'Indisponible'"></element>
                </p>
            </div>
            <table id="download">
                <tbody>
                <thead>
                <tr>
                    <td></td>
                    <td>Score</td>
                    <td>LD</td>
                    <td>720p</td>
                    <td>1080p</td>
                    <td>Premium</td>
                </tr>
                </thead>
                <tbody>
                <tr v-for="season in saisons" class="bold">
                    <td>{{formatValue(season.label)}}</td>
                    <td class="score">{{formatValue(season.score)}}</td>
                    <td>
                        <a v-if="season.linkLowDef" target="_blank" v-bind:href="parseLink(season.linkLowDef)">
                            <img src="https://otaku-family.fr/uploads/ressources/uptobox.png">
                        </a>
                        <template v-else>Indisponible</template>
                    </td>
                    <td>
                        <a v-if="season.link720p" target="_blank" v-bind:href="parseLink(season.link720p)">
                            <img src="https://otaku-family.fr/uploads/ressources/uptobox.png">
                        </a>
                        <template v-else>Indisponible</template>
                    </td>
                    <td>
                        <a v-if="season.link1080p" target="_blank" v-bind:href="parseLink(season.link1080p)">
                            <img src="https://otaku-family.fr/uploads/ressources/uptobox.png">
                        </a>
                        <template v-else>Indisponible</template>
                    </td>
                    <td>
                        <a v-if="season.linkPremium" target="_blank" v-bind:href="parseLink(season.linkPremium)">
                            <img src="https://otaku-family.fr/uploads/ressources/uptobox.png">
                        </a>
                        <template v-else>Indisponible</template>
                    </td>

                </tr>
                </tbody>

            </table>
        </div>

    </div>
  </div>
<hr/>
<hr/>

<!-- Code -->

<div class="animeCode">
    <h2>Code HTML</h2>
    <div id="code">

        <button id="copyCode" class="btnCopy" data-clipboard-target="#generatedHtml">Copier</button>
        <pre id="generatedHtml">
  <code>&lt;div id="complements"&gt;
    &lt;p class="affiche"&gt;<template v-if="picture">&lt;img src=" {{ picture }} " alt=" {{ title }} " /&gt;</template>
    &lt;/p&gt;
  &lt;/div&gt;
  &lt;div id="info"&gt;
    &lt;p&gt;
      &lt;span&gt;
        &lt;b&gt;Titre alternatif&lt;/b&gt; : {{ title }}
      &lt;/span&gt;
      &lt;br/&gt;&lt;br/&gt;
      &lt;b&gt;Origine&lt;/b&gt; : {{formatValue(origin)}}&lt;br/&gt;
      &lt;b&gt;Catégorie&lt;/b&gt; : {{formatValue(category)}}&lt;br/&gt;
      &lt;b&gt;Genre(s)&lt;/b&gt; : {{formatValue(genre)}}&lt;br/&gt;
      &lt;b&gt;Théme(s)&lt;/b&gt; : {{formatValue(theme)}}&lt;br/&gt;
      &lt;b&gt;Public visé&lt;/b&gt; : {{formatValue(targetedAudience)}}&lt;br/&gt;
      &lt;b&gt;Nombre d'épisode&lt;/b&gt; : {{formatValue(episodeNumber)}}&lt;br/&gt;
      &lt;b&gt;Durée d'un épisode&lt;/b&gt; : {{formatDurationMins(episodeDuration)}}&lt;br/&gt;
      &lt;b&gt;Saison&lt;/b&gt; : {{formatValue(firstDiffusionQuarter)}}&lt;br/&gt;
      &lt;b&gt;Année de production&lt;/b&gt; : {{formatValue(yearProduction)}}&lt;br/&gt;
      &lt;b&gt;Diffusion&lt;/b&gt; : {{formatValue(diffusionStatus)}}&lt;br/&gt;
      &lt;b&gt;Studio(s) d'animation&lt;/b&gt; : {{formatValue(animationStudio)}}&lt;br/&gt;&lt;br/&gt;
      &lt;b&gt;Histoire&lt;/b&gt; : {{formatValue(summary)}}
    &lt;/p&gt;
  &lt;/div&gt;
  &lt;table id="download"&gt;
    &lt;tbody&gt;
      &lt;tr&gt;
        &lt;td&gt;&lt;/td&gt;
        &lt;td&gt;Score&lt;/td&gt;
        &lt;td&gt;LD&lt;/td&gt;
        &lt;td&gt;720p&lt;/td&gt;
        &lt;td&gt;1080p&lt;/td&gt;
        &lt;td&gt;Premium&lt;/td&gt;
      &lt;/tr&gt;
      <template v-for="season in saisons">&lt;tr class="bold"&gt;
        &lt;td&gt; {{ formatValue(season.label) }} &lt;/td&gt;
        &lt;td class="score"&gt; {{ formatValue(season.score) }} &lt;/td&gt;
        &lt;td&gt;<template v-if="season.linkLowDef">&lt;a target="_blank" href="{{parseLink(season.linkLowDef)}}" ></span>"&gt;&lt;img src="https://otaku-family.fr/uploads/ressources/uptobox.png"&gt;&lt;/a&gt;</template><template v-else>Indisponible</template>&lt;/td&gt;
        &lt;td&gt;<template v-if="season.link720p">&lt;a target="_blank" href="{{parseLink(season.link720p)}}" ></span>"&gt;&lt;img src="https://otaku-family.fr/uploads/ressources/uptobox.png"&gt;&lt;/a&gt;</template><template v-else>Indisponible</template>&lt;/td&gt;
        &lt;td&gt;<template v-if="season.link1080p">&lt;a target="_blank" href="{{parseLink(season.link1080p)}}" ></span>"&gt;&lt;img src="https://otaku-family.fr/uploads/ressources/uptobox.png"&gt;&lt;/a&gt;</template><template v-else>Indisponible</template>&lt;/td&gt;
        &lt;td&gt;<template v-if="season.linkPremium">&lt;a target="_blank" href="{{parseLink(season.linkPremium)}}" ></span>"&gt;&lt;img src="https://otaku-family.fr/uploads/ressources/uptobox.png"&gt;&lt;/a&gt;</template><template v-else>Indisponible</template>&lt;/td&gt;
      &lt;/tr&gt;</template>
    &lt;/tbody&gt;
  &lt;/table&gt;</code></pre>
    </div>
</div>
</div>     
<script>
    // If data is loaded from another page, mounted() method will use it for initialisation
    preloadedData= {   
    <?php if(isset($_POST['url']) && !empty($_POST['url'])) : ?>
      "isPreloaded":true,
      "title": "<?php echo htmlspecialchars_decode($infos[0]) ?>",
			"origin": "<?php echo htmlspecialchars_decode($infos[1]) ?>",
			"category": "<?php echo htmlspecialchars_decode($infos[2]) ?>",
			"genre": "<?php echo htmlspecialchars_decode($infos[3]) ?>",
			"theme": "<?php echo htmlspecialchars_decode($infos[4]) ?>",
			"targetedAudience": "<?php echo htmlspecialchars_decode($infos[5]) ?>",
			"episodeNumber": "<?php echo htmlspecialchars_decode($infos[6]) ?>",
			"episodeDuration": "<?php echo htmlspecialchars_decode($infos[7]) ?>",
			"firstDiffusionQuarter": "<?php echo htmlspecialchars_decode($infos[8]) ?>",
			"yearProduction": "<?php echo htmlspecialchars_decode($infos[9]) ?>",
			"diffusionStatus": "<?php echo htmlspecialchars_decode($infos[10]) ?>",
			"animationStudio": "<?php echo htmlspecialchars_decode($infos[11]) ?>",
            "summary": "<?php echo htmlspecialchars_decode($infos[12]) ?>",
			<?php endif; ?>
    }
    </script>
<script>
      var clipboard = new Clipboard('#copyCode')
      var app = new Vue({
        el: '#app',
        data: {
          title: null,
          picture: null,
          origin: 'Indisponible',
          category: 'Indisponible',
          genre: null,
          theme: null,
          targetedAudience: 'Indisponible',
          episodeNumber: null,
          episodeDuration: null,
          firstDiffusionQuarter: 'Indisponible',
          yearProduction: null,
          diffusionStatus: 'Indisponible',
          animationStudio: null,
          summary: null,
          saisons: [{
            label: null,
            score: null,
            linkLowDef: null,
            link720p: null,
            link1080p: null,
            linkPremium: null
          }]
        },
        mounted(){
          // overriding default values with extraction from page
          if(preloadedData.isPreloaded){
            this.title = preloadedData.title
            this.origin = preloadedData.origin
            this.category = preloadedData.category
            this.genre = preloadedData.genre
            this.theme = preloadedData.theme
            this.targetedAudience = preloadedData.targetedAudience
            this.episodeNumber = preloadedData.episodeNumber
            this.episodeDuration = preloadedData.episodeDuration
            this.firstDiffusionQuarter = preloadedData.firstDiffusionQuarter
            this.yearProduction = preloadedData.yearProduction
            this.diffusionStatus = preloadedData.diffusionStatus
            this.animationStudio = preloadedData.animationStudio
            this.summary = preloadedData.summary
          }
        },
        methods: {
          formatValue(value) {
            return value ? value : 'Indisponible'
          },
          formatDurationMins(duration) {
            return duration ? duration + ' mins' : 'Indisponible'
          },
          parseLink(id) {
            return "https://otaku-family.fr/parser.php?acc_id=0&id=" + id
          },
          addSeason() {
            this.saisons.push({
              label: null,
              score: null,
              linkLowDef: null,
              link720p: null,
              link1080p: null,
              linkPremium: null
            })
          },
          removeSeason() {
            this.saisons.pop()
          },
          initFromUrl(url){
            //Get html content
            let pageContent = this.loadPage(url)
            console.log(pageContent)
            // 
            let title = (''+/<h1>(.*?)<\/h1>/.exec('<h1>test</h1>')[1]).trim()
          },
          loadPage(href)
            {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", href, false);
                xmlhttp.send();
                return xmlhttp.responseText;
            }
        }
      })
    </script>
</body>

</html>