<?php
declare(strict_types = 1);

namespace Abiodunjames\Prodigypdf\Contracts;

interface PDFContract
{
    /**
     * Get the DomPDF instance
     *
     * @return \DOMPDF
     */
    public function getDomPDF();

    /**
     * Set the paper size (default A4)
     *
     * @param string $paper
     * @param string $orientation
     * @return $this
     */
    public function setPaper($paper, $orientation = 'portrait');

    /**
     * Set the orientation (default portrait)
     *
     * @param string $orientation
     * @return static
     */
    public function setOrientation($orientation);

    /**
     * Show or hide warnings
     *
     * @param bool $warnings
     * @return $this
     */
    public function setWarnings($warnings);

    /**
     * Load a HTML string
     *
     * @param string $string
     * @param string $encoding Not used yet
     * @return static
     */
    public function loadHTML($string, $encoding = null);

    /**
     * Load a HTML file
     *
     * @param string $file
     * @return static
     */
    public function loadFile($file);

    /**
     * Load a View and convert to HTML
     *
     * @param string $view
     * @param array $data
     * @param array $mergeData
     * @param string $encoding Not used yet
     * @return static
     */
    public function loadView($view, $data = array(), $mergeData = array(), $encoding = null);

    /**
     * Output the PDF as a string.
     *
     * @return string The rendered PDF as string
     */
    public function output();

    /**
     * Save the PDF to a file
     *
     * @param $filename
     * @return static
     */
    public function save($filename);

    /**
     * Save to a location
     * @param string $path
     * @param  bool $public
     * @return mixed
     */
    public  function saveToPath($path='/', $public=false);
    /**
     * Make the PDF downloadable by the user
     *
     * @param string $filename
     * @return \Illuminate\Http\Response
     */
    public function download($filename = 'document.pdf');

    /**
     * Return a response with the PDF to show in the browser
     *
     * @param string $filename
     * @return \Illuminate\Http\Response
     */
    public function stream($filename = 'document.pdf');

    /**
     * @param string $recipient
     * @param null $subject
     * @param null $body
     * @return mixed
     *
     */
    public  function sendTo($recipient,$subject=null,$body=null);
}
