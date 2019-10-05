<?php

namespace AGelm\CriticalCss\CssManager;

/**
 * The purpose of this interface is to manage the critical-path CSS.
 */
interface CriticalManagerInterface
{
    public function __construct(string $chain,
                            StorageInterface $storage);

    public function render($css);

    public function get($css);

}
