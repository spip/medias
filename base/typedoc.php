<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2014                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) return;

global $tables_images, $tables_sequences, $tables_documents, $tables_mime, $mime_alias;

$tables_images = array(
			// Images reconnues par PHP
			'jpg' => 'JPEG',
			'png' => 'PNG',
			'gif' => 'GIF',

			// Autres images (peuvent utiliser le tag <img>)
			'bmp' => 'BMP',
			);

// Multimedia (peuvent utiliser le tag <embed>)

$tables_sequences = array(
			'aac' => 'Advanced Audio Coding',
			'ac3' => 'AC-3 Compressed Audio',
			'aifc' => 'Compressed AIFF Audio',
			'aiff' => 'AIFF',
			'amr' => 'Adaptive Multi-Rate Audio',
			'anx' => 'Annodex',
			'ape' => 'Monkey\'s Audio File',
			'axa' => 'Annodex Audio',
			'axv' => 'Annodex Video',
			'asf' => 'Windows Media',
			'avi' => 'AVI',
			'dv'	=> 'Digital Video',
			'f4a' => 'Audio for Adobe Flash Player',
			'f4b' => 'Audio Book for Adobe Flash Player',
			'f4p' => 'Protected Video for Adobe Flash Player',
			'f4v' => 'Video for Adobe Flash Player',
			'flac' => 'Free Lossless Audio Codec',
			'flv' => 'Flash Video',
			'm2p' => 'MPEG-PS',
			'm2ts' => 'BDAV MPEG-2 Transport Stream',
			'm4a' => 'MPEG4 Audio',
			'm4b' => 'MPEG4 Audio',
			'm4p' => 'MPEG4 Audio',
			'm4r' => 'iPhone Ringtone',
			'm4v' => 'MPEG4 Video',
			'mid' => 'Midi',
			'mng' => 'MNG',
			'mka' => 'Matroska Audio',
			'mkv' => 'Matroska Video',
			'mov' => 'QuickTime',
			'mp3' => 'MP3',
			'mp4' => 'MPEG4',
			'mpc' => 'Musepack',
			'mpg' => 'MPEG',
			'mts' => 'AVCHD MPEG-2 transport stream',
			'oga' => 'Ogg Audio',
			'ogg' => 'Ogg Vorbis',
			'ogv' => 'Ogg Video',
			'ogx' => 'Ogg Multiplex',
			'qt' => 'QuickTime',
			'ra' => 'RealAudio',
			'ram' => 'RealAudio',
			'rm' => 'RealAudio',
			'spx' => 'Ogg Speex',
			'svg' => 'Scalable Vector Graphics',
			'svgz' => 'Compressed Scalable Vector Graphic',
			'swf' => 'Flash',
			'tif' => 'TIFF',
			'ts' => 'MPEG transport stream',
			'wav' => 'WAV',
			'webm' => 'WebM',
			'wma' => 'Windows Media Audio',
			'wmv' => 'Windows Media Video',
			'y4m' => 'YUV4MPEG2',
			'3ga' => '3GP Audio File',
			'3gp' => '3rd Generation Partnership Project'
		);

// Documents varies
$tables_documents = array(
			'7z' => '7 Zip',
			'abw' => 'Abiword',
			'ai' => 'Adobe Illustrator',
			'asx' => 'Advanced Stream Redirector',
			'bib' => 'BibTeX',
			'bz2' => 'BZip',
			'bin' => 'Binary Data',
			'blend' => 'Blender',
			'c' => 'C source',
			'cls' => 'LaTeX Class',
			'csl' => 'Citation Style Language',
			'css' => 'Cascading Style Sheet',
			'csv' => 'Comma Separated Values',
			'deb' => 'Debian',
			'doc' => 'Word',
			'dot' => 'Word Template',
			'djvu' => 'DjVu',
			'dvi' => 'LaTeX DVI',
			'emf' => 'Enhanced Metafile',
			'enl' => 'EndNote Library',
			'ens' => 'EndNote Style',
			'epub' => 'EPUB',
			'eps' => 'PostScript',
			'gpx' => 'GPS eXchange Format',
			'gz' => 'GZ',
			'h' => 'C header',
			'html' => 'HTML',
			'jar' => 'Java Archive',
			'json' => 'JSON',
			'kml' => 'Keyhole Markup Language',
			'kmz' => 'Google Earth Placemark File',
			'lyx' => 'Lyx file',
			'mathml' => 'MathML',
			'mbtiles' => 'MBTiles',
			'm3u' => 'M3U Playlist',
			'm3u8' => 'M3U8 Playlist',
			'm4u' => 'MPEG4 Playlist',
			'pas' => 'Pascal',
			'pdf' => 'PDF',
			'pgn' => 'Portable Game Notation',
			'pls' => 'Playlist',
			'pot' => 'PowerPoint Template',
			'ppt' => 'PowerPoint',
			'ps' => 'PostScript',
			'psd' => 'Photoshop',
			'rar' => 'WinRAR',
			'rdf' => 'Resource Description Framework',
			'ris' => 'RIS',
			'rpm' => 'RedHat/Mandrake/SuSE',
			'rtf' => 'RTF',
			'sdc' => 'StarOffice Spreadsheet',
			'sdd' => 'StarOffice Presentation',
			'sdw' => 'StarOffice Writer document',
			'sit' => 'Stuffit',
			'sla' => 'Scribus',
			'srt' => 'SubRip Subtitle',
			'ssa' => 'SubStation Alpha Subtitle',
			'sty' => 'LaTeX Style Sheet',
			'sxc' => 'OpenOffice.org Calc',
			'sxi' => 'OpenOffice.org Impress',
			'sxw' => 'OpenOffice.org',
			'tar' => 'Tar',
			'tex' => 'LaTeX',
			'tgz' => 'TGZ',
			'torrent' => 'BitTorrent',
			'ttf' => 'TTF Font',
			'txt' => 'Texte',
			'usf' => 'Universal Subtitle Format',
			'wmf' => 'Windows Metafile',
			'wpl' => 'Windows Media Player Playlist',
			'xcf' => 'GIMP multi-layer',
			'xspf' => 'XSPF',
			'xls' => 'Excel',
			'xlt' => 'Excel Template',
			'xml' => 'XML',
			'y4m' => 'YUV4MPEG2',
			'yaml' => 'YAML',
			'zip' => 'Zip',

			// open document format
			
			'odb' => 'OpenDocument Database',
			'odc' => 'OpenDocument Chart',
			'odf' => 'OpenDocument Formula',
			'odg' => 'OpenDocument Graphics',
			'odi' => 'OpenDocument Image',
			'odm' => 'OpenDocument Text-master',
			'odp' => 'OpenDocument Presentation',
			'ods' => 'OpenDocument Spreadsheet',
			'odt' => 'OpenDocument Text',
			'otg' => 'OpenDocument Graphics-template',
			'otp' => 'OpenDocument Presentation-template',
			'ots' => 'OpenDocument Spreadsheet-template',
			'ott' => 'OpenDocument Text-template',


			// Open XML File Formats
			'docm' => 'Word',
			'docx' => 'Word',
			'dotm' => 'Word template',
			'dotx' => 'Word template',

			'potm' => 'Powerpoint template',
			'potx' => 'Powerpoint template',
			'ppam' => 'Powerpoint addin',
			'ppsm' => 'Powerpoint slideshow',
			'ppsx' => 'Powerpoint slideshow',
			'pptm' => 'Powerpoint',
			'pptx' => 'Powerpoint',

			'xlam' => 'Excel',
			'xlsb' => 'Excel binary',
			'xlsm' => 'Excel',
			'xlsx' => 'Excel',
			'xltm' => 'Excel template',
			'xltx' => 'Excel template'
		);

$tables_mime = array(
		// Images reconnues par PHP
		'jpg' => 'image/jpeg',
		'png' => 'image/png',
		'gif' => 'image/gif',

		// Autres images (peuvent utiliser le tag <img>)
		'bmp' => 'image/x-ms-bmp', // pas enregistre par IANA, variante: image/bmp
		'tif' => 'image/tiff',
		
		// Multimedia (peuvent utiliser le tag <embed>)
		'aac' => 'audio/mp4a-latm',
		'ac3' => 'audio/x-aac',
		'aifc' => 'audio/x-aifc',
		'aiff' => 'audio/x-aiff',
		'amr' => 'audio/amr',
		'ape' => 'audio/x-monkeys-audio',
		'asf' => 'video/x-ms-asf',
		'avi' => 'video/x-msvideo',
		'anx' => 'application/annodex',
		'axa' => 'audio/annodex',
		'axv' => 'video/annodex',
		'dv' => 'video/x-dv',
		'f4a' => 'audio/mp4',
		'f4b' => 'audio/mp4',
		'f4p' => 'video/mp4',
		'f4v' => 'video/mp4',
		'flac' => 'audio/x-flac',
		'flv' => 'video/x-flv',
		'm2p' => 'video/MP2P',
		'm2ts' => 'video/MP2T',
		'm4a' => 'audio/mp4a-latm',
		'm4b' => 'audio/mp4a-latm',
		'm4p' => 'audio/mp4a-latm',
		'm4r' => 'audio/aac',
		'm4u' => 'video/vnd.mpegurl',
		'm4v' => 'video/x-m4v',
		'mid' => 'audio/midi',
		'mka' => 'audio/mka',
		'mkv' => 'video/mkv',
		'mng' => 'video/x-mng',
		'mov' => 'video/quicktime',
		'mp3' => 'audio/mpeg',
		'mp4' => 'application/mp4',
		'mpc' => 'audio/x-musepack',
		'mpg' => 'video/mpeg',
		'mts' => 'video/MP2T',
		'oga' => 'audio/ogg',
		'ogg' => 'audio/ogg',
		'ogv' => 'video/ogg',
		'ogx' => 'application/ogg',
		'qt' => 'video/quicktime',
		'ra' => 'audio/x-pn-realaudio',
		'ram' => 'audio/x-pn-realaudio',
		'rm' => 'audio/x-pn-realaudio',
		'spx' => 'audio/ogg',
		'svg' => 'image/svg+xml',
		'svgz' => 'image/svg+xml',
		'swf' => 'application/x-shockwave-flash',
		'ts' => 'video/MP2T',
		'wav' => 'audio/x-wav',
		'webm' => 'video/webm',
		'wma' => 'audio/x-ms-wma',
		'wmv' => 'video/x-ms-wmv',
		'y4m' => 'video/x-raw-yuv',
		'3gp' => 'video/3gpp',
		'3ga' => 'audio/3ga',

		// Documents varies
		'7z' => 'application/x-7z-compressed',
		'ai' => 'application/illustrator',
		'abw' => 'application/abiword',
		'asx' => 'video/x-ms-asf',
		'bib' => 'application/x-bibtex',
		'bin' => 'application/octet-stream', # le tout-venant
		'blend' => 'application/x-blender',
		'bz2' => 'application/x-bzip2',
		'c'  => 'text/x-csrc',
		'csl' => 'application/xml',
		'css' => 'text/css',
		'csv' => 'text/csv',
		'deb' => 'application/x-debian-package',
		'doc' => 'application/msword',
		'dot' => 'application/msword',
		'djvu' => 'image/vnd.djvu',
		'dvi' => 'application/x-dvi',
		'emf' => 'image/x-emf',
		'enl' => 'application/octet-stream',
		'ens' => 'application/octet-stream',
		'eps' => 'application/postscript',
		'epub' => 'application/epub+zip', // pas enregistre par IANA
		'gpx' => 'application/gpx+xml', // pas enregistre par IANA
		'gz' => 'application/x-gzip',
		'h'  => 'text/x-chdr',
		'html' => 'text/html',
		'jar' => 'application/java-archive',
		'json' => 'application/json',
		'kml' => 'application/vnd.google-earth.kml+xml',
		'kmz' => 'application/vnd.google-earth.kmz',
		'lyx' => 'application/x-lyx',
		'm3u' => 'text/plain',
		'm3u8' => 'text/plain',
		'mathml' => 'application/mathml+xml',
		'mbtiles' => 'application/x-sqlite3',
		'pas' => 'text/x-pascal',
		'pdf' => 'application/pdf',
		'pgn' => 'application/x-chess-pgn',
		'pls' => 'text/plain',
		'ppt' => 'application/vnd.ms-powerpoint',
		'pot' => 'application/vnd.ms-powerpoint',
		'ps' => 'application/postscript',
		'psd' => 'image/x-photoshop', // pas enregistre par IANA
		'rar' => 'application/x-rar-compressed',
		'rdf' => 'application/rdf+xml',
		'ris' => 'application/x-research-info-systems',
		'rpm' => 'application/x-redhat-package-manager',
		'rtf' => 'application/rtf',
		'sdc' => 'application/vnd.stardivision.calc',
		'sdd' => 'application/vnd.stardivision.impress',
		'sdw' => 'application/vnd.stardivision.writer',
		'sit' => 'application/x-stuffit',
		'sla' => 'application/x-scribus',
		'srt' => 'text/plain',
		'ssa' => 'text/plain',
		'sxc' => 'application/vnd.sun.xml.calc',
		'sxi' => 'application/vnd.sun.xml.impress',
		'sxw' => 'application/vnd.sun.xml.writer',
		'tar' => 'application/x-tar',
		'tex' => 'text/x-tex',
		'tgz' => 'application/x-gtar',
		'torrent' => 'application/x-bittorrent',
		'ttf' => 'application/x-font-ttf',
		'txt' => 'text/plain',
		'usf' => 'application/xml',
		'xcf' => 'application/x-xcf',
		'xls' => 'application/vnd.ms-excel',
		'xlt' => 'application/vnd.ms-excel',
		'wmf' => 'image/x-emf',
		'wpl' => 'application/vnd.ms-wpl',
		'xspf' => 'application/xspf+xml',
		'xml' => 'application/xml',
		'yaml' => 'text/yaml',
		'zip' => 'application/zip',

		// Open Document format
		'odt' => 'application/vnd.oasis.opendocument.text',
		'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
		'odp' => 'application/vnd.oasis.opendocument.presentation',
		'odg' => 'application/vnd.oasis.opendocument.graphics',
		'odc' => 'application/vnd.oasis.opendocument.chart',
		'odf' => 'application/vnd.oasis.opendocument.formula',
		'odb' => 'application/vnd.oasis.opendocument.database',
		'odi' => 'application/vnd.oasis.opendocument.image',
		'odm' => 'application/vnd.oasis.opendocument.text-master',
		'ott' => 'application/vnd.oasis.opendocument.text-template',
		'ots' => 'application/vnd.oasis.opendocument.spreadsheet-template',
		'otp' => 'application/vnd.oasis.opendocument.presentation-template',
		'otg' => 'application/vnd.oasis.opendocument.graphics-template',

		'cls' => 'text/x-tex',
		'sty' => 'text/x-tex',

		// Open XML File Formats
		'docm' => 'application/vnd.ms-word.document.macroEnabled.12',
		'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'dotm' => 'application/vnd.ms-word.template.macroEnabled.12',
		'dotx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',

		'potm' => 'application/vnd.ms-powerpoint.template.macroEnabled.12',
		'potx' => 'application/vnd.openxmlformats-officedocument.presentationml.template',
		'ppam' => 'application/vnd.ms-powerpoint.addin.macroEnabled.12',
		'ppsm' => 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
		'ppsx' => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
		'pptm' => 'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
		'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',

		'xlam' => 'application/vnd.ms-excel.addin.macroEnabled.12',
		'xlsb' => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
		'xlsm' => 'application/vnd.ms-excel.sheet.macroEnabled.12',
		'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		'xltm' => 'application/vnd.ms-excel.template.macroEnabled.12',
		'xltx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template'
	);


	$mime_alias = array (
		'application/x-ogg' => 'application/ogg',
		'audio/3gpp' => 'video/3gpp',
		'audio/x-mpeg' => 'audio/mpeg',
		'audio/x-musepack' => 'audio/musepack',
		'audio/webm' => 'video/webm',
		'video/flv' => 'video/x-flv',
		'video/mp4' => 'application/mp4',
		'image/jpg' => 'image/jpeg'
	);

?>
