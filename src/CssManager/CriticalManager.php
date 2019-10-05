<?php

namespace AGelm\CriticalCss\CssManager;


/**
 * The purpose of this interface is to manage the critical-path CSS.
 */
class CriticalManager implements CriticalManagerInterface
{

    protected $chain;

    protected $storage;

    protected $css;

    protected $opts;

    public function __construct(array $Opts = [])
    {
        $this->opts = $this->setOption($Opts);
    };

    public function setOption(array $option = [])
    {
        $opts = \file_get_contents( realpath(__FILE__) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "critical-path-css.php" );

        return array_map($opts, $option);
    }

    public function render()
    {
        echo sprintf( '<style>%s</style>',
                $this->get()
            );
    };

    public function get()
    {
        if( $css = file_get_contents(
            rtrim( $this->opts['storage'], DIRECTORY_SEPARATOR ) . DIRECTORY_SEPARATOR . $this->opts['call_back_file']
            )
        ) else {
            throw new CriticalMnanagerException(
                sprintf('ERROR! The callback file %s dont exists, pleas create it
                or check the config.',
                rtrim( $this->opts['storage'], DIRECTORY_SEPARATOR ) . DIRECTORY_SEPARATOR . $this->opts['call_back_file'] )
            );
        }

        foreach ($this->opts['chain'] as $file) {
         $$file = str_replace( $this->opts['extension'], array(""), $file);

            if( file_exists( rtrim( $this->opts['storage'], DIRECTORY_SEPARATOR ) . DIRECTORY_SEPARATOR . $$file . ".css" ) )
            {
                $css = file_get_contents( rtrim( $this->opts['storage'], DIRECTORY_SEPARATOR ) . DIRECTORY_SEPARATOR . $$file . ".css");
            }
        }

        return $this->css = $css;
    }

}
