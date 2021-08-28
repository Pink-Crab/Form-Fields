<?php

declare(strict_types=1);

/**
 * Button property.
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

namespace PinkCrab\Form_Fields\Traits;

trait Button {

	/**
	 * Get the formaction value
	 *
	 * @return mixed
	 */
	public function get_form_action() {
		return array_key_exists( 'formaction', $this->attributes )
			? (string) $this->attributes['formaction']
			: '';
	}

	/**
	 * Set the formaction value
	 *
	 * @param string $form_action  The formaction value
	 * @return self
	 */
	public function form_action( string $form_action = '' ): self {
		if ( \mb_strlen( $form_action ) !== 0 ) {
			$this->attribute( 'formaction', $form_action );
		} else {
			$this->unset_attribute( 'formaction' );
		}

		return $this;
	}

	/**
	 * Get the formenctype value
	 *
	 * @return mixed
	 */
	public function get_form_enctype() {
		return array_key_exists( 'formenctype', $this->attributes )
			? (string) $this->attributes['formenctype']
			: '';
	}

	/**
	 * Set the formenctype value
	 *
	 * @param string $form_enctype  The formenctype value
	 * @return self
	 */
	public function form_enctype( string $form_enctype = '' ): self {
		$accepted_form_enctypes = array( 'application/x-www-form-urlencoded', 'multipart/form-data', 'text/plain' );
		if ( \mb_strlen( $form_enctype ) !== 0 && in_array( \strtolower( $form_enctype ), $accepted_form_enctypes, true ) ) {
			$this->attribute( 'formenctype', $form_enctype );
		} else {
			$this->unset_attribute( 'formenctype' );
		}

		return $this;
	}

	/**
	 * Get the formmethod value
	 *
	 * @return mixed
	 */
	public function get_form_method() {
		return array_key_exists( 'formmethod', $this->attributes )
			? (string) $this->attributes['formmethod']
			: '';
	}

	/**
	 * Set the formmethod value
	 *
	 * @param string$method  The formmethod value
	 * @return self
	 */
	public function form_method( string $method = '' ): self {
		$accepted_methods = array( 'get', 'post' );

		if ( \mb_strlen( $method ) !== 0 && in_array( \strtolower( $method ), $accepted_methods, true ) ) {
			$this->attribute( 'formmethod', $method );
		} else {
			$this->unset_attribute( 'formmethod' );
		}

		return $this;
	}

	/**
	 * Get the formnovalidate value
	 *
	 * @return string
	 */
	public function get_form_no_validate() {
		return array_key_exists( 'formnovalidate', $this->attributes )
			? 'formnovalidate'
			: '';
	}

	/**
	 * Set the formnovalidate value
	 *
	 * @param bool $no_validate  The form no validate value (if set to true, will not validate any form submitted by this button.)
	 * @return self
	 */
	public function form_no_validate( bool $no_validate = true ): self {
		if ( true === $no_validate ) {
			$this->attribute( 'formnovalidate', 'formnovalidate' );
		} else {
			$this->unset_attribute( 'formnovalidate' );
		}

		return $this;
	}

	/**
	 * Get the form target value
	 *
	 * @return mixed
	 */
	public function get_form_target() {
		return array_key_exists( 'formtarget', $this->attributes )
			? (string) $this->attributes['formtarget']
			: '';
	}

	/**
	 * Set the form target value
	 *
	 * @param string $formtarget  The formtarget value
	 * @return self
	 */
	public function form_target( $formtarget = '' ): self {
		if ( \mb_strlen( (string) $formtarget ) !== 0 ) {
			$this->attribute( 'formtarget', (string) $formtarget );
		} else {
			$this->unset_attribute( 'formtarget' );
		}

		return $this;
	}
}
