<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Indsro Demo ZIP Handler.
 *
 * Extracts uploads.zip directly into wp-content/uploads/.
 */
class Indsro_Demo_Zip_Handler {

    /**
     * Extract a ZIP file to a destination directory.
     *
     * @param string $zip_path  Absolute path to the ZIP file.
     * @param string $dest_path Absolute path to the destination directory.
     * @return true|\WP_Error
     */
    public static function extract( string $zip_path, string $dest_path ) {
        if ( ! file_exists( $zip_path ) ) {
            return new \WP_Error( 'zip_not_found', 'ZIP file not found: ' . basename( $zip_path ) );
        }

        if ( ! class_exists( 'ZipArchive' ) ) {
            // Fallback to WP unzip.
            WP_Filesystem();
            $result = unzip_file( $zip_path, $dest_path );
            if ( is_wp_error( $result ) ) {
                return $result;
            }
            return true;
        }

        $zip = new \ZipArchive();
        $res = $zip->open( $zip_path );

        if ( true !== $res ) {
            return new \WP_Error( 'zip_open_failed', 'Could not open ZIP file. Error code: ' . $res );
        }

        // Ensure destination exists.
        if ( ! is_dir( $dest_path ) ) {
            wp_mkdir_p( $dest_path );
        }

        $zip->extractTo( $dest_path );
        $zip->close();

        return true;
    }

    /**
     * Extract the uploads.zip into wp-content/uploads/.
     *
     * @return true|\WP_Error
     */
    public static function extract_uploads() {
        $zip_urls = [
            'https://themexriver.com/wp/indsro/uploads.zip',
            // Add your fallback URLs here:
            'https://drive.google.com/uc?export=download&id=1Oh6K8Wfk3sJt3uLPGjpDLIOij5rwUpfM',
        ];

        Indsro_Demo_Progress::add_log( 'Downloading remote uploads.zip...' );

        if ( ! function_exists( 'download_url' ) ) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }

        // Increase time limit for large downloads
        if ( function_exists( 'set_time_limit' ) ) {
            @set_time_limit( 600 );
        }

        $tmp_zip = null;
        $download_success = false;

        foreach ( $zip_urls as $url ) {
            Indsro_Demo_Progress::add_log( 'Attempting to download from: ' . $url );
            $tmp_zip = download_url( $url, 300 );

            if ( ! is_wp_error( $tmp_zip ) ) {
                $download_success = true;
                Indsro_Demo_Progress::add_log( 'Successfully downloaded from: ' . $url );
                break; // Stop trying once we have a successful download
            } else {
                Indsro_Demo_Progress::add_log( 'Failed to download from ' . $url . ': ' . $tmp_zip->get_error_message() );
            }
        }

        if ( ! $download_success ) {
            Indsro_Demo_Progress::add_log( 'All attempts to download remote uploads.zip failed.' );
            // Return true because uploads.zip is optional and we don't want to crash import
            return true;
        }

        $upload_dir = wp_upload_dir();
        $dest       = $upload_dir['basedir'];

        Indsro_Demo_Progress::add_log( 'Extracting uploads.zip (' . size_format( filesize( $tmp_zip ) ) . ')...' );

        $result = self::extract( $tmp_zip, $dest );

        // Clean up the temporary zip file after extraction
        @unlink( $tmp_zip );

        if ( is_wp_error( $result ) ) {
            return $result;
        }

        Indsro_Demo_Progress::add_log( 'Uploads extracted successfully.' );

        return true;
    }
}
