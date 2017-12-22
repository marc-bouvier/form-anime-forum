<!DOCTYPE html>
<html>
	<head>
	    <meta charset="UTF-8">
		<title>Otaku Family - Fiches</title>
		<link rel="stylesheet" type="text/css" href="/uploads/ressources/generator.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i">
		<link rel="shortcut icon" href="favicon.ico">
		<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
		<!-- Load JsRender latest version, from www.jsviews.com: -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jsrender/0.9.84/jsrender.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jsviews/0.9.87/jsviews.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
	</head>
	<body>
	
		<!-- Loader -->
	
		<div id="animeCode">
		<?php
		function getInfos($url){
			$HTML = file_get_contents($url); // Recup le HTML de la page
			if(!$HTML) return;
			preg_match('/<h1>(.*?)<\/h1>/', $HTML, $Name); 
			preg_match('/Origine : <\/b>(.*?)<\/div>/', $HTML, $Origin); 
			preg_match('/Catégorie : <\/b>(.*?)<\/div>/', $HTML, $Cat);
			preg_match_all('/<a href=\"\/genre\/fiche\/[0-9]+.html\">(.*?)<\/a>/', $HTML, $genre);
			$strGenre = "";
			foreach($genre[1] as $value){
				$strGenre .= $value . ", ";
			}
			preg_match_all('/<a href=\"\/theme\/fiche\/[0-9]+.html\">(.*?)<\/a>/', $HTML, $theme);
			$strTheme = "";
			foreach($theme[1] as $value){
				$strTheme .= $value . ", ";
			}
			preg_match('/<b>Public visé : <\/b>(.*?)<\/div>/', $HTML, $Public);
			preg_match('/Nombre d\'épisode : <\/b>(.*?)<\/div>/', $HTML, $EpisodeNb);
			preg_match('/Durée d\'un épisode : <\/b>(.*?)mins/', $HTML, $EpisodeTime);
			preg_match('/Saison : <\/b>(.*?)<\/div>/', $HTML, $Saison);
			preg_match('/Année de production : <\/b>(.*?)<\/div>/', $HTML, $Prod);
			preg_match('/Diffusion : <\/b>(.*?)<\/div>/', $HTML, $Diff);
			preg_match_all('/<a href=\"\/studio\/fiche\/[0-9]+.html\">(.*?)<\/a>/', $HTML, $Studio);
			$strStudio = "";
			foreach($Studio[1] as $value){
				$strStudio .= $value . ", ";
			}
			preg_match('/<p align=\'justify\'>(.*?)<br \/>/',$HTML, $Story);
			$infos = array(
				trim($Name[1]), // Name
				trim($Origin[1]),	
				trim($Cat[1]),
				trim($strGenre),
				trim($strTheme),
				trim($Public[1]),  // 5
				trim($EpisodeNb[1]),
				trim($EpisodeTime[1]),
				trim($Saison[1]),
				trim($Prod[1]),
				trim($Diff[1]), // 10
				trim($strStudio),
				trim($Story[1]), // 12
				$genre[1],
				$theme[1],
			);
			return $infos;
		}
		if(isset($_POST['url']) && !empty($_POST['url'])){
			$infos = getInfos($_POST['url']);
		}
		?>
			<h2>Loader</h2>
			<form action="" method="POST" class="form">
				<input type="text" name="url" placeholder="URL Icotaku">
				<button class="btnCopy">Charger les infos</button>
			</form>
		</div>
		
		<hr>
		<hr>
		
		<!-- Form -->
		
		<div id="animeData">
			<div id="formRender">
				<h2>Formulaire de fiche d'animé</h2>
				<div id="form">
					<table class="form">
						<tbody>
							<tr>
								<th><label>Nom de l'anime</label></th>
								<td><input type="text" data-link="title"/>
								</td>
							</tr>

							<tr>
								<th> <label>Image de l'anime</label></th>
								<td> <input type="text" data-link="picture" />
								</td>
							</tr>
							<tr>
								<th> <label>Origine</label> </th>
								<td>
									<select type="text" data-link="origin">
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
								<th><label>Catégorie</label></th>
								<td>
									<select data-link="category">
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
								<th><label>Genre(s)</label></th>
								<td><input type="text" data-link="genre" />
								</td>
							</tr>
							<tr>
								<th><label>Thème(s)</label></th>
								<td><input type="text" data-link="theme" />
								</td>
							</tr>
							<tr>
								<th><label>Public visé</label></th>
								<td>
									<select data-link="targetedAudience">
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
								<th><label>Nombre d'épisodes</label></th>
								<td><input type="number" data-link="episodeNumber" />
								</td>
							</tr>
							<tr>
								<th><label>Durée d'un épisode (min)</label></th>
								<td> <input type="number" data-link="episodeDuration" />
								</td>
							</tr>
							<tr>
								<th><label>Saison</label></th>
								<td>
									<select data-link="firstDiffusionQuarter">
											<option value="Indisponible">Faites un choix</option>
											<option value="Printemps">Printemps</option>
											<option value="Été">Été</option>
											<option value="Automne">Automne</option>
											<option value="Hiver">Hiver</option>
										</select>
								</td>
							</tr>
							<tr>
								<th><label>Année de production</label></th>
								<td> <input type="number" data-link="yearProduction" />
								</td>
							</tr>
							<tr>
								<th> <label>Diffusion</label></th>
								
								<td class="diff">
									<select data-link="diffusionStatus">
										<option value="Indisponible">Faites un choix</option>
										<option value="En cours">En cours</option>
										<option value="Terminée">Terminé</option>
									</select>
								</td>
							</tr>
							<tr>
								<th><label>Studio(s) d'animation</label></th>
								<td>
									<input type="text" data-link="animationStudio" />
								</td>
							</tr>
						</tbody>
					</table>
					<table class="formhistory">
						<tbody>
							<tr>
								<th> <label>Histoire</label></th>
								<td><textarea data-link="summary"></textarea></td>
							</tr>
						</tbody>
					</table>
					<span data-link="{for seasons tmpl='#formSeason'}"></span>
					<button data-link="{on addSeason}">+</button><button data-link="{on removeSeason}">-</button>
				</div>
			</div>
			<script id="formSeason" type="text/x-jsrender">
				<table class="formSeason">
					<tbody>
						<tr>
							<th>Saison</th>
							<td><input data-link="label" /></td>
						</tr>
						<tr>
							<th>Score</th>
							<td><input type="number" step="any" placeholder="MyAnimeList Score : 0,00" data-link="score" /></td>
						</tr>
						<tr>
							<th>LD</th>
							<td><input placeholder="ID du dossier Uptobox" data-link="linkLowDef" /></td>
						</tr>
						<tr>
							<th>720p</th>
							<td><input placeholder="ID du dossier Uptobox" data-link="link720p" /></td>
						</tr>
						<tr>
							<th>1080p</th>
							<td><input placeholder="ID du dossier Uptobox" data-link="link1080p" /></td>
						</tr>
						<tr>
							<th>Premium</th>
							<td><input placeholder="Lien direct Uptobox" data-link="linkPremium" /></td>
						</tr>
					</tbody>
				</table>
				<br/>
			</script>
			
		<!-- Preview -->
		
			<div id="previewRender">
				<h2>Visualisation</h2>
				<div id="prewiew">
					<div id="complements">
						<p class="affiche">
							<img data-link="src{:picture} alt{:title}"/>
						</p>
					</div>

					<div id="info">
						<p>
							<span>
							<b>Titre alternatif</b> : <span data-link="title"></span>
							</span>
							<br/><br/>
							<b>Origine</b> : <element data-link="origin||'Indisponible'"></element><br/>
							<b>Catégorie</b> : <element data-link="category||'Indisponible'"></element><br/>
							<b>Genre(s)</b> : <element data-link="genre||'Indisponible'"></element><br/>
							<b>Théme(s)</b> : <element data-link="theme||'Indisponible'"></element><br/>
							<b>Public visé</b> : <element data-link="targetedAudience||'Indisponible'"></element><br/>
							<b>Nombre d'épisode</b> : <element data-link="episodeNumber||'Indisponible'"></element><br/>
							<b>Durée d'un épisode</b> : <element data-link="episodeDuration||'Indisponible'"></element><element data-link="visible{:episodeDuration}"> mins</element><br/>
							<b>Saison</b> : <element data-link="firstDiffusionQuarter||'Indisponible'"></element><br/>
							<b>Année de production</b> : <element data-link="yearProduction||'Indisponible'"></element><br/>
							<b>Diffusion</b> : <element data-link="diffusionStatus||'Indisponible'"></element><br/>
							<b>Studio(s) d'animation</b> : <element data-link="animationStudio||'Indisponible'"></element><br/><br/>
							<b>Histoire</b> : <element data-link="summary||'Indisponible'"></element>
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
							<thead data-link="{for seasons tmpl='#previewSeason'}" />
					</table>
				</div>
				<script id="previewSeason" type="text/x-jsrender">
					<tr class="bold">
						<td><span data-link="label||'Indisponible'"></span></td>
						<td class="score"><span data-link="score"></span></td>
						<td>
							{^{if linkLowDef}}
							<a target="_blank" data-link="href{linkParser:linkLowDef}">
								<img src="https://otaku-family.fr/uploads/ressources/uptobox.png">
							</a>
							{{else}} Indisponible {{/if}}
						</td>
						<td>
							{^{if link720p}}
							<a target="_blank" data-link="href{linkParser:link720p}">
								<img src="https://otaku-family.fr/uploads/ressources/uptobox.png">
							</a>
							{{else}} Indisponible {{/if}}
						</td>
						<td>
							{^{if link1080p}}
							<a target="_blank" data-link="href{linkParser:link1080p}">
								<img src="https://otaku-family.fr/uploads/ressources/uptobox.png">
							</a>
							{{else}} Indisponible {{/if}}
						</td>
						<td>
							{^{if linkPremium}}
							<a target="_blank" data-link="href{:linkPremium}">
								<img src="https://otaku-family.fr/uploads/ressources/uptobox.png">
							</a>
							{{else}} Indisponible {{/if}}
						</td>
					</tr>
				</script>
				<!-- <span data-link="{if linkLowDef tmpl='#previewLinkUpToBox'}{else tmpl='Indisponible'}"></span> -->
				<script id="previewLinkUpToBox" type="text/x-jsrender">
					<a target="_blank" data-link="href{:~root}">
						<img src="https://otaku-family.fr/uploads/ressources/uptobox.png">
					</a>
				</script>
			</div>
		</div>
		
	<hr>
	<hr>
	
		<!-- Code -->
		
		<div id="animeCode">
			<h2>Code HTML</h2>
			<div id="code">
				<button class="btnCopy" data-clipboard-target="#generatedHtml">Copier</button>
				<pre id="generatedHtml">
<code>&lt;div id="complements"&gt;
	&lt;p class="affiche"&gt;<span data-link="visible{:picture}">
		&lt;img src="<span data-link="picture"></span>" alt="<span data-link="title"></span>" /&gt;</span>
	&lt;/p&gt;
&lt;/div&gt;
&lt;div id="info"&gt;
	&lt;p&gt;
		&lt;span&gt;
			&lt;b&gt;Titre alternatif&lt;/b&gt; : <span data-link="title"></span>
		&lt;/span&gt;
		&lt;br/&gt;&lt;br/&gt;
		&lt;b&gt;Origine&lt;/b&gt; : <element data-link="origin||'Indisponible'"></element>&lt;br/&gt;
		&lt;b&gt;Catégorie&lt;/b&gt; : <element data-link="category||'Indisponible'"></element>&lt;br/&gt;
		&lt;b&gt;Genre(s)&lt;/b&gt; : <element data-link="genre||'Indisponible'"></element>&lt;br/&gt;
		&lt;b&gt;Théme(s)&lt;/b&gt; : <element data-link="theme||'Indisponible'"></element>&lt;br/&gt;
		&lt;b&gt;Public visé&lt;/b&gt; : <element data-link="targetedAudience||'Indisponible'"></element>&lt;br/&gt;
		&lt;b&gt;Nombre d'épisode&lt;/b&gt; : <element data-link="episodeNumber||'Indisponible'"></element>&lt;br/&gt;
		&lt;b&gt;Durée d'un épisode&lt;/b&gt; : <element data-link="episodeDuration||'Indisponible'"></element><element data-link="visible{:episodeDuration}"> mins</element>&lt;br/&gt;
		&lt;b&gt;Saison&lt;/b&gt; : <element data-link="firstDiffusionQuarter||'Indisponible'"></element>&lt;br/&gt;
		&lt;b&gt;Année de production&lt;/b&gt; : <element data-link="yearProduction||'Indisponible'"></element>&lt;br/&gt;
		&lt;b&gt;Diffusion&lt;/b&gt; : <element data-link="diffusionStatus||'Indisponible'"></element>&lt;br/&gt;
		&lt;b&gt;Studio(s) d'animation&lt;/b&gt; : <element data-link="animationStudio||'Indisponible'"></element>&lt;br/&gt;&lt;br/&gt;
		&lt;b&gt;Histoire&lt;/b&gt; : <element data-link="summary||'Indisponible'"></element>
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
		&lt;/tr&gt;<element data-link="{for seasons tmpl='#htmlSeason'}"></element>	&lt;/tbody&gt;
&lt;/table&gt;</code></pre>
			</div>
		</div>
		<script id="htmlSeason" type="text/x-jsrender"><pre>		&lt;tr class="bold"&gt;
			&lt;td&gt;<span data-link="label||'Indisponible'"></span>&lt;/td&gt;
			&lt;td class="score"&gt;<span data-link="score"></span>&lt;/td&gt;
			&lt;td&gt;{^{if linkLowDef}}&lt;a target="_blank" href="<span data-link="{linkParser:linkLowDef}" ></span>"&gt;&lt;img src="https://otaku-family.fr/uploads/ressources/uptobox.png"&gt;&lt;/a&gt;{{else}}Indisponible{{/if}}&lt;/td&gt;
			&lt;td&gt;{^{if link720p}}&lt;a target="_blank" href="<span data-link="{linkParser:link720p}"></span>"&gt;&lt;img src="https://otaku-family.fr/uploads/ressources/uptobox.png"&gt;&lt;/a&gt;{{else}}Indisponible{{/if}}&lt;/td&gt;
			&lt;td&gt;{^{if link1080p}}&lt;a target="_blank" href="<span data-link="{linkParser:link1080p}"></span>"&gt;&lt;img src="https://otaku-family.fr/uploads/ressources/uptobox.png"&gt;&lt;/a&gt;{{else}}Indisponible{{/if}}&lt;/td&gt;
			&lt;td&gt;{^{if linkPremium}}&lt;a target="_blank" href="<span data-link="linkPremium"></span>"&gt;&lt;img src="https://otaku-family.fr/uploads/ressources/uptobox.png"&gt;&lt;/a&gt;{{else}}Indisponible{{/if}}&lt;/td&gt;
		&lt;/tr&gt;</pre></script>
		<script>
        $.views.converters({
            linkParser: function(id) {
                return "https://otaku-family.fr/parser.php?acc_id=0" + id
            }
        });
        var data = {
			<?php if(isset($_POST['url']) && !empty($_POST['url'])) : ?>
            "title": "<?php echo $infos[0] ?>",
			"origin": "<?php echo $infos[1] ?>",
			"category": "<?php echo $infos[2] ?>",
			"genre": "<?php echo $infos[3] ?>",
			"theme": "<?php echo $infos[4] ?>",
			"targetedAudience": "<?php echo $infos[5] ?>",
			"episodeNumber": "<?php echo $infos[6] ?>",
			"episodeDuration": "<?php echo $infos[7] ?>",
			"firstDiffusionQuarter": "<?php echo $infos[8] ?>",
			"yearProduction": "<?php echo $infos[9] ?>",
			"diffusionStatus": "<?php echo $infos[10] ?>",
			"animationStudio": "<?php echo $infos[11] ?>",
            "summary": "<?php echo $infos[12] ?>",
			<?php endif; ?>
            "picture": "",
            "seasons": [{
                "label": "Saison 01"
            }],
            "addSeason": function() {
                $.observable(this.seasons).insert({});
            },
            "removeSeason": function() {
                if (this.seasons.length > 1) {
                    $.observable(this.seasons).remove();
                }
            }

        };
        $.link(true, "#animeData,#animeCode", data);

        var clipboard = new Clipboard('.btnCopy')
		</script>
	</body>
</html>