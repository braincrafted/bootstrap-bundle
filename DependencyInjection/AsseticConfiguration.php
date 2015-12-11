<?php
/**
 * This file is part of BraincraftedBootstrapBundle.
 *
 * (c) 2012-2013 by Florian Eckerstorfer
 */

namespace Braincrafted\Bundle\BootstrapBundle\DependencyInjection;

/**
 * AsseticConfiguration
 *
 * @package    BraincraftedBootstrapBundle
 * @subpackage DependencyInjection
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class AsseticConfiguration
{
    /**
     * Builds the assetic configuration.
     *
     * @param array $config
     *
     * @return array
     */
    public function build(array $config)
    {
        $output = array();

        // Fix path in output dir
        if ('/' !== substr($config['output_dir'], -1) && strlen($config['output_dir']) > 0) {
            $config['output_dir'] .= '/';
        }

        // changed from css_preprocessor to css_preprocessor for 3.0
        if (in_array($config['css_preprocessor'], array('sass', 'scssphp'))) {
            $output['bootstrap_css'] = $this->buildCssWithSass($config);
        } elseif ('none' !== $config['css_preprocessor']) {
            $output['bootstrap_css'] = $this->buildCssWithLess($config);
        } else {
            $output['bootstrap_css'] = $this->buildCssWithoutLess($config);
        }

        $output['bootstrap_js'] = $this->buildJs($config);
        $output['jquery'] = $this->buildJquery($config);

        return $output;
    }

    /**
     * @param array $config
     *
     * @return array
     */
    protected function buildCssWithoutLess(array $config)
    {
        $inputs = array(
            $config['assets_dir'].'/dist/css/bootstrap.css',
        );
        if ('fa' === $config['icon_prefix']) {
            $inputs[] = $config['fontawesome_dir'].'/css/font-awesome.css';
        }

        return array(
            'inputs'  => $inputs,
            'filters' => array('cssrewrite'),
            'output'  => $config['output_dir'].'css/bootstrap.css'
        );
    }

    /**
     * @param array $config
     *
     * @return array
     */
    protected function buildCssWithLess(array $config)
    {
        $bootstrapFile = $config['assets_dir'].'/less/bootstrap.less';
        if (true === isset($config['customize']['variables_file']) &&
            null !== $config['customize']['variables_file']) {
            $bootstrapFile = $config['customize']['bootstrap_output'];
        }

        $inputs = array(
            $bootstrapFile,
            __DIR__.'/../Resources/less/form.less'
        );
        if ('fa' === $config['icon_prefix']) {
            $inputs[] = $config['fontawesome_dir'].'/less/font-awesome.less';
        }

        return array(
            'inputs'  => $inputs,
            'filters' => array($config['css_preprocessor']),
            'output'  => $config['output_dir'].'css/bootstrap.css'
        );
    }

    /**
     * @param array $config
     *
     * @return array
     */
    protected function buildCssWithSass(array $config)
    {
        $bootstrapFile = $config['assets_dir'].'/stylesheets/_bootstrap.scss';
        if (true === isset($config['customize']['variables_file']) &&
            null !== $config['customize']['variables_file']) {
            $bootstrapFile = $config['customize']['bootstrap_output'];
        }

        $inputs = array(
            $bootstrapFile,
            __DIR__.'/../Resources/sass/form.scss'
        );
        if ('fa' === $config['icon_prefix']) {
            $inputs[] = $config['fontawesome_dir'].'/scss/font-awesome.scss';
        }

        return array(
            'inputs'  => $inputs,
            'filters' => array($config['css_preprocessor']),
            'output'  => $config['output_dir'].'css/bootstrap.css'
        );
    }

    /**
     * @param array $config
     *
     * @return array
     */
    protected function buildJs(array $config)
    {
        $path = !in_array($config['css_preprocessor'], array('sass', 'scssphp')) ? "/js" : "/javascripts/bootstrap";

        return array(
            'inputs'  => array(
                $config['assets_dir'].$path.'/transition.js',
                $config['assets_dir'].$path.'/alert.js',
                $config['assets_dir'].$path.'/button.js',
                $config['assets_dir'].$path.'/carousel.js',
                $config['assets_dir'].$path.'/collapse.js',
                $config['assets_dir'].$path.'/dropdown.js',
                $config['assets_dir'].$path.'/modal.js',
                $config['assets_dir'].$path.'/tooltip.js',
                $config['assets_dir'].$path.'/popover.js',
                $config['assets_dir'].$path.'/scrollspy.js',
                $config['assets_dir'].$path.'/tab.js',
                $config['assets_dir'].$path.'/affix.js',
                __DIR__.'/../Resources/js/bc-bootstrap-collection.js'
            ),
            'output'        => $config['output_dir'].'js/bootstrap.js'
        );
    }

    /**
     * @param array $config
     *
     * @return array
     */
    protected function buildJquery(array $config)
    {
        return array(
            'inputs' => array($config['jquery_path']),
            'output' => $config['output_dir'].'js/jquery.js'
        );
    }
}
