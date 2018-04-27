<?php
/*
Template Name: Inserisci articoli
*/
?>

<?php

// Aggiorna contatore
$fr = fopen('./contatore.txt', 'a+');
$count = file_get_contents('./contatore.txt');
++$count;
$fr = fopen('./contatore.txt', 'w+');
fwrite($fr, $count);
fclose($fr);
$count = file_get_contents('./contatore.txt');
$id_progressivo = $count;

	//connessione DB
	$host = "localhost";
	$db_user = "root";
	$db_psw = "";
	$db_name = "milannews24";

	$connessione = mysql_connect("$host","$db_user","$db_psw");
	if(!$connessione) { die("Errore critico di Connessione al Database" . mysql_error()); }

	mysql_set_charset('utf8');

	//connessione
	mysql_select_db("$db_name",$connessione);
	$ris_news= mysql_query("SELECT * FROM articoli WHERE ID_ARTICOLO = $id_progressivo ORDER BY ID_ARTICOLO ASC");
	if (!$ris_news) {
	 	exit ('<p> Errore mentre recuperavo i dati' . mysql_error() . '</p>');
	}

	if (mysql_num_rows($ris_news)== 0) {

		// Log ID non presenti
		$sep = ",";
		$fp = fopen('./log-id.txt', 'a');
		fwrite($fp, $id_progressivo);
		fwrite($fp, $sep);
		fclose($fp);

	} else {
  // loop per stampare i risultati
  while ($news= mysql_fetch_array($ris_news))
  {

   	// Estrae il primo carattere del contenuto
   	$news_first_char = substr($news['TESTO'], 0, 1);


   	// Rimuove immagini e tags html all'interno del contenuto
   	//Strip tags html con whitelist
		$html = strip_tags($news['TESTO'],'<h1><h2><h3><h4><h5><h6><a><b><p><ul><ol><li><blockquote><q><cite><ins><del><strong><em><code><pre><svg><table><thead><tbody><tfoot><th><tr><td><dl><dt><dd><article><section><header><footer><aside><figure><time><abbr><hr><small><br>');

		//Elimino stile inline a paragrafi, intestazioni e immagini
		$stripped_text = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $html);

		//Replace <b> with <strong>
		$old_items = array("<b>","</b>");
		$new_items = array("<strong>","</strong>");
		$contenuto = str_replace($old_items, $new_items, $stripped_text);


   		echo "First char: ".$news_first_char."<br>";

	   	echo $news['ID_ARTICOLO'];
	   	echo "<br />";
	   	echo $news['TITOLO'];
	   	echo "<br />";

	   	//Se il primo carattere del contenuto è '?' lo strippa
		 	if ($news_first_char == '?') {
	   		$news_testo = substr($contenuto, 1);
   		} else {
	   		$news_testo = $contenuto;
   		}
   		echo $news_testo;
			echo "<br />";

		 	echo $news['DATA'];
		 	echo "<br />";
	  	echo "<hr />";


	    // Normal filtering
	    remove_filter('title_save_pre', 'wp_filter_kses');
	    remove_filter( 'pre_comment_content', 'wp_filter_post_kses' );
	    remove_filter( 'pre_comment_content', 'wp_filter_kses' );
	    remove_filter('content_save_pre', 'wp_filter_post_kses');
	    remove_filter('excerpt_save_pre', 'wp_filter_post_kses');


	    //Insert WP
			$my_post = array(
			  'post_title'    => $news['TITOLO'],
			  'post_content'  =>  $news_testo,
			  //'post_name'=> $id_progressivo."-".$news['TITOLO'],
			  //'guid' => $news['slug'],
			  'post_status'   => 'publish',
			  'post_category' => array(3), //Id categoria
			  'post_author'   => 2,
			  'post_date' => $news['DATA']
			);


		// Insert the post into the database
		$post_id = wp_insert_post( $my_post );
		//echo $post_id;


		// Set featured image
		if( ! is_wp_error( $post_id ) )
      update_post_meta( $post_id, '_thumbnail_id', 4 );



 	}//While insert POST

 	};
?>