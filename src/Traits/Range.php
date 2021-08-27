<?php

declare(strict_types=1);

/**
 * Range field trait, adds min, max and step
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

trait Range {

	/**
	 * The min value
	 *
	 * @var mixed
	 */
	protected $min;

	/**
	 * The max value
	 *
	 * @var mixed
	 */
	protected $max;

	/**
	 * Step value.
	 *
	 * @var mixed
	 */
	protected $step;


	/**
	 * Get the min value
	 *
	 * @return mixed
	 */
	public function get_min() {
		return $this->min;
	}

	/**
	 * Set the min value
	 *
	 * @param mixed $min  The min value
	 * @return self
	 */
	public function min( $min ): self {
		$this->min = $min;
		return $this;
	}

	/**
	 * Get the max value
	 *
	 * @return mixed
	 */
	public function get_max() {
		return $this->max;
	}

	/**
	 * Set the max value
	 *
	 * @param mixed $max  The max value
	 * @return self
	 */
	public function max( $max ): self {
		$this->max = $max;
		return $this;
	}

	/**
	 * Get step value.
	 * @return mixed
	 */
	public function get_step() {
		return $this->step;
	}

	/**
	 * Set step value.
	 *
	 * @param mixed $step  Step value.
	 * @return self
	 */
	public function step( $step ): self {
		$this->step = $step;
		return $this;
	}
}
