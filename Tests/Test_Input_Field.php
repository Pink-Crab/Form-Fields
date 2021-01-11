<?php

declare(strict_types=1);

/**
 * Input with type TEXT tests.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\ExtLibs\Admin_Pages
 */

namespace PinkCrab\Modules\Form_Fields\Tests;

use WP_UnitTestCase;
use PinkCrab\Modules\Form_Fields\Fields\Input_Text;
use PinkCrab\Modules\Form_Fields\Fields\Abstract_Field;
use PinkCrab\Modules\Form_Fields\Tests\Trait_General_Field_Tests;

require_once 'Trait_General_Field_Tests.php';

class Test_Input_Field extends WP_UnitTestCase {

	protected $field_type = Input_Text::class;

	/**
	 * Rendered isntance of the field.
	 *
	 * @var Abstract_Field
	 */
	protected static $field;

	/**
	 * Include all shared tests via trait.
	 */
	use Trait_General_Field_Tests;

	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Input_Text::create( 'key', 'label' );
	}
}
