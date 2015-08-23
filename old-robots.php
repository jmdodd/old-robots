<?php
/**
 * Plugin Name: WordPress Support Forums Old Robots
 * Description: Add noindex,nofollow to old closed topics.
 * Version: 1.0
 * Author: Jennifer M. Dodd
 */

/**
 *	This program is free software; you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License, version 2, as
 *	published by the Free Software Foundation.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program; if not, see <http://www.gnu.org/licenses/>.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'WPORG_Old_Robots' ) ) {
class WPORG_Old_Robots {
	public function __construct() {
		add_action( 'wp_head', array( $this, 'maybe_add_robots' ) );
	}

	function maybe_add_robots() {
		global $post;

		if (
			is_singular()
		&&
			bbp_is_topic( $post->ID )
		&&
			bbp_is_topic_closed( $post->ID )
		&&
			( time() - get_post_time( 'U', true, $post ) > YEAR_IN_SECONDS )
		) {
			echo '<meta name="robots" content="noindex,nofollow" />' . "\n";
		}
	}
} }


new WPORG_Old_Robots;
