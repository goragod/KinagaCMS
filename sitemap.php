<?php
/*
  * @copyright  Copyright (C) 2017 Gari-Hari LLC. All rights reserved.
  * @license    GPL 3.0 or later; see LICENSE file for details.
  */

include_once 'includes' . DIRECTORY_SEPARATOR . 'config.php';

header( 'Content-Type: text/plain; charset=' . $encoding );

$glob = glob( '{' . $glob_dir . 'index.html,contents' . $s . '*.html}', GLOB_BRACE + GLOB_NOSORT );

if ( $glob ) {

	foreach( $glob as $files ) {

		$sort[] = !is_link( $files ) && !is_link( dirname( $files ) ) && !is_link( dirname( dirname( $files ) ) ) ? filemtime( $files ) . '-~-' . $files : '';

	}

	$sort = array_filter( $sort );

	rsort( $sort );

	for( $i = 0, $c = count( $sort ); $i < $c; ++$i ) {

		$part = explode( '-~-', $sort[$i] );

		$categ = basename( dirname( dirname( $part[1] ) ) );

		$title = basename( dirname( $part[1] ) );

		if ( $title == 'contents' ) {

			$page = basename( $part[1], '.html' );

			if ( $page == 'index' ) {

				echo $url . $n;

			} else {

				echo $url . rawurlencode( $page ) . $n;

			}

		} else {

			echo $url . rawurlencode( $categ ) . $s . rawurlencode( $title ) . $n;

		}

	}

}

if ( $use_contact === true ) echo $url . rawurlencode( $contact_us );
