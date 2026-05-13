<?php

namespace App\Services;

use Smalot\PdfParser\Parser;
use PhpOffice\PhpWord\IOFactory;

class ResumeParserService
{
    public function extractText($file)
    {
        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        if ($extension === 'pdf') {
            return $this->parsePdf($file);
        }

        if ($extension === 'docx') {
            return $this->parseDocx($file);
        }

        throw new \Exception('Unsupported file format');
    }

    private function parsePdf($file)
    {
        $parser = new Parser();

        $pdf = $parser->parseFile(
            $file->getPathname()
        );

return $this->cleanText($pdf->getText());
    }

    private function parseDocx($file)
    {
        $phpWord = IOFactory::load(
            $file->getPathname()
        );

        $text = '';

        foreach ($phpWord->getSections() as $section) {

            foreach ($section->getElements() as $element) {

                if (method_exists($element, 'getText')) {

                    $text .= $element->getText() . ' ';
                }
            }
        }

return $this->cleanText($text);    }

private function cleanText($text)
{
    // remove escaped newlines
    $text = str_replace("\\n", " ", $text);

    // remove multiple spaces
    $text = preg_replace('/\s+/', ' ', $text);

    // remove weird symbols
    $text = preg_replace('/[^\PC\s]/u', '', $text);

    // trim
    return trim($text);
}
}