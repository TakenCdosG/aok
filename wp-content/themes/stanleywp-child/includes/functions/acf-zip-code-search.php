<?php
/**
* Create Database table for geodata
*/
global $my_db_version;
$my_db_version = '1.1';

function my_install() {
global $wpdb;
global $my_db_version;

$table_name = $wpdb->prefix . 'my_geodata';

/*
* We'll set the default character set and collation for this table.
* If we don't do this, some characters could end up being converted
* to just ?'s when saved in our table.
*/
$charset_collate = '';

if ( ! empty( $wpdb->charset ) ) {
$charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
}

if ( ! empty( $wpdb->collate ) ) {
$charset_collate .= " COLLATE {$wpdb->collate}";
}

$sql = "CREATE TABLE $table_name (
id mediumint(9) NOT NULL AUTO_INCREMENT,
user_id BIGINT NULL UNIQUE,
lat DECIMAL(9,6) NULL,
lng DECIMAL(9,6) NULL,
UNIQUE KEY id (id)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );

add_option( 'my_db_version', $my_db_version );
}

function my_geodata_update_db_check() {
global $my_db_version;
if ( get_site_option( 'my_db_version' ) != $my_db_version ) {
my_install();
}
}
add_action( 'init', 'my_geodata_update_db_check' );



/**
 * Insert geodata into table
 */
function insert_geodata( $data ) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'my_geodata';

    //Check date validity
    if( !is_float($data['lat']) || !is_float($data['lng']) || !is_int($data['user_id']) )
        return 0;

    $wpdb->insert(
        $table_name,
        array(
            'user_id' => $data['user_id'],
            'lat'     => $data['lat'],
            'lng'     => $data['lng'],
        ),
        array(
            '%d',
            '%f',
            '%f'
        )
    );
}

/**
 * Checks if entry for user_id exists
 */
function check_geodata($user_id) {

    global $wpdb;
    $table_name = $wpdb->prefix . 'my_geodata';

    //Check date validity
    if( !is_int($user_id) )
        return 0;

    $sql = "SELECT * FROM $table_name WHERE user_id = $user_id";
    $geodata = $wpdb->get_row($sql);

    if($geodata) {
        return true;
    }
}


/**
 * Delete entry for user_id
 */
function delete_geodata($user_id) {

    global $wpdb;
    $table_name = $wpdb->prefix . 'my_geodata';

    //Check date validity
    if( !is_int($user_id) )
        return 0;

    $delete = $wpdb->delete( $table_name, array( 'user_id' => $user_id ) );

    return $delete;
}


/**
 * Update existing
 */
function update_geodata($data) {

    global $wpdb;

    $table_name = $wpdb->prefix . 'my_geodata';

    //Check date validity
    if( !is_float($data['lat']) || !is_float($data['lng']) || !is_int($data['user_id']) )
        return 0;

    $wpdb->update(
        $table_name,
        array(
            'lat'     => $data['lat'],
            'lng'     => $data['lng'],
        ),
        array(
            'user_id' => $data['user_id'],
        ),
        array(
            '%f',
            '%f'
        )
    );
}



/**
 * Insert or update current user geodata
 */
function add_geodata( $data ) {
    global $wpdb;

    //Check date validity
    if( !is_float($data['lat']) || !is_float($data['lng']) || !is_int($data['user_id']) )
        return 0;

    /**
     * Check if geodata exists and update if exists else insert
     */
    if( check_geodata( $data['user_id'] ) ) {
        update_geodata( $data );
    } else {
        insert_geodata( $data );
    }
}


/**
 * Loop trough all clinics and update geodata in custom table
 */
function update_user_geodata() {
    $args = array(
        'role' => 'Contributor'
    );
    $users = get_users( $args );

    if($users):
        foreach($users as $item):

            //$tables  = get_field('tables', $item->ID);
            $address = get_field('location', 'user_'.$item->ID);
            
            /**
             * Update Lat/Lng for every clinic
             */
            $id  = (int) $item->ID;
            $lat = (float) $address['lat'];
            $lng = (float) $address['lng'];

            if( $address ):
                $data = array(
                    'user_id' => $id,
                    'lat'     => $lat,
                    'lng'     => $lng
                );

                add_geodata( $data );
            endif;

        endforeach;
    endif;

}


/**
 * Transient for locations
 * Run update post geodata every hour
 */
if ( false === ( $update_geodata = get_transient( 'locations_update_geodata' ) ) ) {
    update_user_geodata();
    set_transient( 'locations_update_geodata', $update_geodata, 1 * HOUR_IN_SECONDS );
}

// Create a simple function to delete our transient
function my_delete_transient() {
    delete_transient( 'locations_update_geodata' );
}
// Add the function to the edit/save post hook so it runs when user are edited
add_action( 'profile_update', 'my_delete_transient' );
add_action( 'user_register', 'my_delete_transient' );


function bar_get_nearby( $lat, $lng, $limit = 50, $distance = 50, $unit = 'mi' ) {
// radius of earth; @note: the earth is not perfectly spherical, but this is considered the 'mean radius'
    if( $unit == 'km' ) { $radius = 6371.009; }
    elseif ( $unit == 'mi' ) { $radius = 3958.761; }

// latitude boundaries
    $maxLat = ( float ) $lat + rad2deg( $distance / $radius );
    $minLat = ( float ) $lat - rad2deg( $distance / $radius );

// longitude boundaries (longitude gets smaller when latitude increases)
    $maxLng = ( float ) $lng + rad2deg( $distance / $radius) / cos( deg2rad( ( float ) $lat ) );
    $minLng = ( float ) $lng - rad2deg( $distance / $radius) / cos( deg2rad( ( float ) $lat ) );

    $max_min_values = array(
        'max_latitude' => $maxLat,
        'min_latitude' => $minLat,
        'max_longitude' => $maxLng,
        'min_longitude' => $minLng
    );

    return $max_min_values;
}

