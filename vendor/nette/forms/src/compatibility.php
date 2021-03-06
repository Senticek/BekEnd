<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Forms;

if (false) {
	/** @deprecated use Nette\Forms\Control */
	class IControl
	{
	}

	/** @deprecated use Nette\Forms\FormRenderer */
	class IFormRenderer
	{
	}

	/** @deprecated use Nette\Forms\SubmitterControl */
	class ISubmitterControl
	{
	}
} elseif (!interface_exists(IControl::class)) {
	class_alias(Control::class, IControl::class);
	class_alias(FormRenderer::class, IFormRenderer::class);
	class_alias(SubmitterControl::class, ISubmitterControl::class);
}
