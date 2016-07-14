<?php
namespace Neostall\UI\File;

class Kitchencar extends \mimosafa\WP\UI\Post {

	protected $post_type = 'kitchencar';
	protected $uis = [
		[ 'Neostall\\UI\\MetaBox\\LegacyMenuContent', 'context=normal&priority=high' ]
	];

}
