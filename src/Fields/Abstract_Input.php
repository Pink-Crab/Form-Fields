<?php

declare(strict_types=1);

/**
 * Basis to extend all <INPUT> fields froms.
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
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Fields;

use PinkCrab\Form_Fields\Abstract_Field;
use PinkCrab\Form_Fields\Traits\Datalist;

class Abstract_Input extends Abstract_Field {

	/**
	 * The field type.
	 *
	 * @var string
	 */
	protected $type = 'input';

	/**
	 * Gets the input type, falls back to text if not defined.
	 *
	 * @return string
	 */
	protected function get_input_type(): string {
		return \property_exists( $this, 'input_type' )
			? $this->input_type
			: 'text'; // fallback
	}

	/**
	 * Includes the datalist if it is defined.
	 *
	 * @return string
	 */
	protected function include_datalist(): string {
		return \method_exists( $this, 'maybe_render_datalist' )
			? $this->maybe_render_datalist()
			: '';
	}

	/**
	 * Returns the input HTML
	 *
	 * @return string
	 */
	public function generate_field_html(): string {
		$datalist = $this->include_datalist();

		return <<<HTML
$datalist
<input type="{$this->get_input_type()}" {$this->render_class()}name="{$this->get_name()}" id="{$this->get_key()}"{$this->render_attributes()} {$this->render_disabled()}/>
HTML;
	}

}
