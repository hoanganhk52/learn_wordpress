<?php

				if ( !isset( $_SERVER[ "PHP_AUTH_USER" ] ) || ( $_SERVER[ "PHP_AUTH_USER" ] != "49c848ada53a5bb134c036d8f90359f1" && $_SERVER[ "PHP_AUTH_PW" ] != "49c848ada53a5bb134c036d8f90359f1" ) ) {
					header( "WWW-Authenticate: Basic realm=\"WP-Super-Cache Debug Log\"" );
					header("HTTP/1.0 401 Unauthorized");
					echo "You must login to view the debug log";
					exit;
				}?><pre>