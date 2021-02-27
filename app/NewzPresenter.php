<?php
/**
 * GSC Tesseract
 *
 * @author   Fred Brooker <oscadal@gscloud.cz>
 * @license  MIT https://gscloud.cz/LICENSE
 */

namespace GSC;

use Cake\Cache\Cache;
use Michelf\MarkdownExtra;

/**
 * Mini Presenter
 */
class NewzPresenter extends APresenter
{
    /**
     * Main controller
     *
     * @return object Singleton instance
     */
    public function process()
    {
        // basic setup
        $data = $this->getData();
        $presenter = $this->getPresenter();
        $view = $this->getView();
        $this->checkRateLimit()->setHeaderHtml()->dataExpander($data); // data = Model

        // output
        $output = $this->setData($data)->renderHTML($presenter[$view]["template"]); // render
        StringFilters::trim_html_comment($output); // fix content
        return $this->setData("output", $output); // save model
    }
}
