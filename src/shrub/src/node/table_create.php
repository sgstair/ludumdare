<?php

$table = 'SH_TABLE_NODE';
if ( in_array(constant($table), $TABLE_LIST) ) {
	$ok = null;

	// MEDIUMTEXT: 2^24 characters

	table_Init($table);
	switch ( $TABLE_VERSION ) {
	case 0:
		$ok = table_Create( $table,
			"CREATE TABLE ".SH_TABLE_PREFIX.constant($table)." (
				id ".DB_TYPE_UID.",
				parent ".DB_TYPE_ID.",
					INDEX(parent),
				author ".DB_TYPE_ID.",
				type ".DB_TYPE_ASCII(24).",
					INDEX(type),
				subtype ".DB_TYPE_ASCII(24).",
					INDEX(subtype),
				subsubtype ".DB_TYPE_ASCII(24).",
					INDEX(subsubtype),
				published ".DB_TYPE_TIMESTAMP.",
					INDEX(published),
				created ".DB_TYPE_TIMESTAMP.",
				modified ".DB_TYPE_TIMESTAMP.",
				version ".DB_TYPE_ID.",
				slug ".DB_TYPE_ASCII(96).",
					INDEX(slug),
				name ".DB_TYPE_UNICODE(96).",
				body MEDIUMTEXT NOT NULL
			)".DB_CREATE_SUFFIX);
		if (!$ok) break; $TABLE_VERSION++;
	};
	table_Exit($table);

	// Check-for and create necessary nodes
//	node_AddIf('root', 		// check for
//		0,0,				// parent, author
//		'root','','',		// type, subtype, subsubtype
//		0,0,0,				// published, created, modified
//		0,					// version
//		'root','root',		// slug, name
//		''					// body
//	);
//	node_AddIf('users', 	// check for
//		1,1,				// parent, author
//		'users','','',		// type, subtype, subsubtype
//		0,0,0,				// published, created, modified
//		0,					// version
//		'users','Users',	// slug, name
//		''					// body
//	);
}

// Simliar to the regular NODE, but a snapshot
$table = 'SH_TABLE_NODE_VERSION';
if ( in_array(constant($table), $TABLE_LIST) ) {
	$ok = null;

	table_Init($table);
	switch ( $TABLE_VERSION ) {
	case 0:
		$ok = table_Create( $table,
			"CREATE TABLE ".SH_TABLE_PREFIX.constant($table)." (
				id ".DB_TYPE_UID.",
				node ".DB_TYPE_ID.",
					INDEX(node),
				author ".DB_TYPE_ID.",
				type ".DB_TYPE_ASCII(24).",
				subtype ".DB_TYPE_ASCII(24).",
				subsubtype ".DB_TYPE_ASCII(24).",
				timestamp ".DB_TYPE_TIMESTAMP.",
				slug ".DB_TYPE_ASCII(96).",
					INDEX(slug),
				name ".DB_TYPE_UNICODE(96).",
				body MEDIUMTEXT NOT NULL,
				tag ".DB_TYPE_ASCII(32)."
			)".DB_CREATE_SUFFIX);
		if (!$ok) break; $TABLE_VERSION++;
	};
	table_Exit($table);
}


$table = 'SH_TABLE_NODE_LINK';
if ( in_array(constant($table), $TABLE_LIST) ) {
	$ok = null;

	table_Init($table);
	switch ( $TABLE_VERSION ) {
	case 0:
		$ok = table_Create( $table,
			"CREATE TABLE ".SH_TABLE_PREFIX.constant($table)." (
				id ".DB_TYPE_UID.",
				a ".DB_TYPE_ID.",
					INDEX(a),
				b ".DB_TYPE_ID.",
					INDEX(b),
				type ".DB_TYPE_ASCII(24).",
					INDEX(type)
			)".DB_CREATE_SUFFIX);
		if (!$ok) break; $TABLE_VERSION++;
	};
	table_Exit($table);
}


$table = 'SH_TABLE_NODE_META';
if ( in_array(constant($table), $TABLE_LIST) ) {
	$ok = null;
	
	// TEXT: 2^16 characters (65535)
	// TINYINT UNSIGNED: 0-255

	table_Init($table);
	switch ( $TABLE_VERSION ) {
	case 0:
		$ok = table_Create( $table,
			"CREATE TABLE ".SH_TABLE_PREFIX.constant($table)." (
				id ".DB_TYPE_UID.",
				node ".DB_TYPE_ID.",
					INDEX(node),
				scope TINYINT UNSIGNED NOT NULL,
				`key` ".DB_TYPE_ASCII(32).",
				`value` TEXT NOT NULL
			)".DB_CREATE_SUFFIX);
		if (!$ok) break; $TABLE_VERSION++;
	};
	table_Exit($table);
}

/*
$table = 'SH_TABLE_NODE_SEARCH';
if ( in_array(constant($table), $TABLE_LIST) ) {
	$ok = null;
	
	// Use ID only, but manually mirror what's in NODE (unique)?

	table_Init($table);
	switch ( $TABLE_VERSION ) {
	case 0:
		$ok = table_Create( $table,
			"CREATE TABLE ".SH_TABLE_PREFIX.constant($table)." (
				id ".DB_TYPE_UID.",
				node ".DB_TYPE_ID.",
				body MEDIUMTEXT NOT NULL,
					FULLTEXT KEY(node, body)
			)".DB_CREATE_SUFFIX);
		if (!$ok) break; $TABLE_VERSION++;
	};
	table_Exit($table);
}
*/

$table = 'SH_TABLE_NODE_LOVE';
if ( in_array(constant($table), $TABLE_LIST) ) {
	$ok = null;
	
	// NODE: What is love(d), baby don't hurt me
	// AUTHOR: Who loves it
	// IP: IP address of who loves it (if anonymous)
	
	table_Init($table);
	switch ( $TABLE_VERSION ) {
	case 0:
		$ok = table_Create( $table,
			"CREATE TABLE ".SH_TABLE_PREFIX.constant($table)." (
				id ".DB_TYPE_UID.",
				node ".DB_TYPE_ID.",
					INDEX(node),
				author ".DB_TYPE_ID.",
				ip ".DB_TYPE_IP.",
					UNIQUE(author,ip)
			)".DB_CREATE_SUFFIX);
		if (!$ok) break; $TABLE_VERSION++;
	};
	table_Exit($table);
}

$table = 'SH_TABLE_NODE_STAR';
if ( in_array(constant($table), $TABLE_LIST) ) {
	$ok = null;
	
	// AUTHOR: whom likes the thing
	// NODE: what they like
	
	table_Init($table);
	switch ( $TABLE_VERSION ) {
	case 0:
		$ok = table_Create( $table,
			"CREATE TABLE ".SH_TABLE_PREFIX.constant($table)." (
				id ".DB_TYPE_UID.",
				author ".DB_TYPE_ID.",
					INDEX(author),
				node ".DB_TYPE_ID.",
					INDEX(node)
			)".DB_CREATE_SUFFIX);
		if (!$ok) break; $TABLE_VERSION++;
	};
	table_Exit($table);
}