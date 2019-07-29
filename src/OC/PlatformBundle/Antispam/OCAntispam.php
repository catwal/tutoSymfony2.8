<?php
namespace OC\PlatformBundle\Antispam;

class OCAntispam
{
    // Récupération des arguments du services de config/services.yml dans le construct
    private $mailer;
    private $locale;
    private $minLength;

    // récupération des arguments pour stocker dans attributs de la classe et les réutiliser plus tard - garder ordre que dans config
    public function __construct(\Swift_Mailer $mailer, $locale, $minLength)
    {
        $this->mailer = $mailer;
        $this->locale = $locale;
        $this->minLength = (int) $minLength;
    }

    /**
     * Verification of text, spam or not
     * @param $text
     *
     * @return bool
     */
    public function isSpam($text)
    {
        // strlen taille de la chaine
        return strlen($text) < 50;
    }
}