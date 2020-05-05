<?php ob_start(); ?>

<div class="row" id="biography">

    <div class="col s12 m12 l12">

        <!-- Colonne de gauche-->
        <div class="col s12 m12 l5">

            <div class="card" id="biography-img-container">

                <div class="card-image">
                    <img src="Public/img/profile.jpg" alt="Jean Forteroche" id="biography-img" class="responsive-img">
                </div>

            </div>
        </div>


        <!-- Colonne de droite-->
        <div class="col s12 m12 l7 center-align">

            <h4 class=" biography-txt">Biographie</h4>

            <p>Jean Forteroche est né en 1985 à Genève où il vit toujours. </p>
            <p>À l’âge de dix ans, il fonde <strong>La Gazette des animaux</strong>, une revue sur la nature qu’il dirigera pendant sept années et qui lui vaudra de recevoir le Prix Cunéo pour la protection de la nature et d’être désigné « plus jeune rédacteur en chef de Suisse » par la Tribune de Genève.</p>
            <p>Jean Forteroche écrit ensuite ses premiers textes. Son premier roman, <strong>Retrouvailles encore une fois</strong>, est remarqué en 2000 dans le cadre du Prix international des jeunes auteurs.</p>


            <h4 class="biography-txt">Best-sellers</h4>

            <p>Jean Forteroche est l’auteur de romans traduits en 40 langues qui se sont vendus à plus de 10 millions d’exemplaires. </p>
            <p>Son roman <strong>Lumière pour les sirènes</strong> a été le roman francophone le plus vendu de la dernière décennie dans l'édition française. </p>
            <p>Son dernier roman, <strong>Chaudron et cache-misère</strong> a été le livre le plus vendu en France en 2019. </p>


            <h4 class="biography-txt">Prix</h4>

            <p> Son œuvre a été primée dans de nombreux pays. </p>
            <p> En France, il a reçu le prix Erwan Bergot pour <strong>La folie des grandes heures</strong>, puis le Prix de la vocation Bleustein- Blanchet, le Grand prix du roman de l’Académie française et le Prix Goncourt des Lycéens pour <strong>Lumière pour les sirènes</strong>. </p>
            <p> Le roman <strong>Rosae ou le souvenir d'enfance</strong> a été élu parmi « les 101 romans préférés des lecteurs du Monde » et a été adapté en série télévisée en 2019.</p>



        </div>
    </div>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>