<?php

declare(strict_types=1);

/**
 * Holds the settings of a label.
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

namespace PinkCrab\Form_Fields;

class Label_Config {

	/**
	 * Label positioning flags.
	 */
	public const WRAP_LABEL   = 1;
	public const LINKED_LABEL = 2;
	public const BEFORE_INPUT = 4;
	public const AFTER_INPUT  = 8;

	/**
	 * Is the label displayed
	 *
	 * @var bool
	 */
	protected $visibility = false;

	/**
	 * Is the input wrapped in the label
	 *
	 * @var bool
	 */
	protected $wrapped = true;

	/**
	 * Is label positioned above input.
	 *
	 * @var bool
	 */
	protected $position_before = true;

	/**
	 * The classes for the label
	 *
	 * @var string
	 */
	protected $class = '';


	/**
	 * Sets the positioning and wrapping of the label.
	 *
	 * @constants WRAP_LABEL, LINKED_LABEL, BEFORE_INPUT, AFTER_INPUT
	 * @param int $mode
	 * @return self
	 */
	public function set_position( int $mode = self::WRAP_LABEL ) {
		$this->wrapped( ( $mode & self::LINKED_LABEL ) !== self::LINKED_LABEL );
		$this->position_before( ( $mode & self::AFTER_INPUT ) !== self::AFTER_INPUT );
		return $this;
	}

	/**
	 * Set is the label visibility
	 *
	 * @param bool $visibility  Is the label visibilible
	 *
	 * @return self
	 */
	public function visibility( bool $visibility = true ): self {
		$this->visibility = $visibility;
		return $this;
	}

	/**
	 * Set the classes for the label
	 *
	 * @param string|null $class  The classes for the label
	 *
	 * @return self
	 */
	public function classes( ?string $class = null ): self {
		$this->class = $class ?? '';
		return $this;
	}

	/**
	 * Set is the input wrapped in the label
	 *
	 * @param bool $wrapped  Is the input wrapped in the label
	 *
	 * @return self
	 */
	public function wrapped( bool $wrapped = true ): self {
		$this->wrapped = $wrapped;
		return $this;
	}

	/**
	 * Set is label positioned above input.
	 *
	 * @param bool $position_before  Is label positioned above input.
	 * @return self
	 */
	public function position_before( bool $position_before = true ): self {
		$this->position_before = $position_before;
		return $this;
	}

	/**
	 * Get is the input wrapped in the label
	 *
	 * @return bool
	 */
	public function is_wrapped(): bool {
		return $this->wrapped;
	}

	/**
	 * Get is label positioned above input.
	 *
	 * @return bool
	 */
	public function is_positioned_before(): bool {
		return $this->position_before;
	}

	/**
	 * Get is the label visibility
	 *
	 * @return bool
	 */
	public function is_visible(): bool {
		return $this->visibility;
	}

	/**
	 * Get the classes for the label
	 *
	 * @return string|null
	 */
	public function get_classes(): ?string {
		return ! empty( $this->class ) ? " class=\"{$this->class}\"" : '';
	}

}
