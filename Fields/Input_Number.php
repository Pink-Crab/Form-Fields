<?php

declare(strict_types=1);

/**
 * A settings field data.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\ExtLibs\Admin_Pages
 */

namespace PinkCrab\Modules\Form_Fields\Fields;

use PinkCrab\Modules\Form_Fields\Fields\Abstract_Field;

class Input_Number extends Input_Text {

	/**
	 * The field type.
	 *
	 * @var string
	 */
	protected $type = 'input';

	/**
	 * Sets the input type
	 *
	 * @var string
	 */
	protected $input_type = 'number';

	/**
	 * The min value
	 *
	 * @var float
	 */
	protected $min;

	/**
	 * The max value
	 *
	 * @var float
	 */
	protected $max;

	/**
	 * Stepg value.
	 *
	 * @var float
	 */
	protected $step;


	/**
	 * Get the min value
	 *
	 * @return float
	 */
	public function get_min(): float {
		return $this->min;
	}

	/**
	 * Set the min value
	 *
	 * @param float $min  The min value
	 * @return self
	 */
	public function min( float $min ): self {
		$this->min = $min;
		return $this;
	}

	/**
	 * Get the max value
	 *
	 * @return float
	 */
	public function get_max(): float {
		return $this->max;
	}

	/**
	 * Set the max value
	 *
	 * @param float $max  The max value
	 * @return self
	 */
	public function max( float $max ): self {
		$this->max = $max;
		return $this;
	}

	/**
	 * Get stepg value.
	 * @return float
	 */
	public function get_step(): float {
		return $this->step;
	}

	/**
	 * Set stepg value.
	 *
	 * @param float $step  Stepg value.
	 * @return self
	 */
	public function step( float $step ): self {
		$this->step = $step;
		return $this;
	}

	/**
	 * Renders the text input.
	 *
	 * @return void
	 */
	public function render(): void {
		if ( $this->min ) {
			$this->attribute( 'min', (string) $this->get_min() );
		}
		if ( $this->max ) {
			$this->attribute( 'max', (string) $this->get_max() );
		}
		if ( $this->step ) {
			$this->attribute( 'step', (string) $this->get_step() );
		}
		parent::render();
	}
}


