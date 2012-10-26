<?php

class Voice
{
	private static $voices = array(
		'alex', 'bruce', 'fred', 'junior', 'agnes', 'kathy', 'princess', 'vicki', 'victoria', 'albert',
		'bad news', 'bahh', 'bells', 'boing', 'bubbles', 'cellos', 'deranged',
		'good news', 'hysterical', 'pipe organ', 'trinoids', 'whisper', 'zarvox',
	);

	private $voice;

	/**
	 * Create new voice for named voice
	 */
	public function __construct($voice)
	{
		if (!in_array($voice, self::$voices)) {
			throw new Exception('No such voice, ' . $voice);
		}

		$this->voice = $voice;
	}

    /**
     * Say the given phrase using system "say" command
     * @param string $phrase Phrase to say
     */
    public function say($phrase)
	{
		$safePhrase = escapeshellarg($phrase);
		passthru("say -v {$this->voice} $safePhrase");
	}

    /**
     * Say the phrase with a randomly chosen voice
     * @param string $phrase Phrase to say
     */
    public static function sayWithRandomVoice($phrase)
    {
        $index = mt_rand(0, count(self::$voices) - 1);
        $v = new Voice(self::$voices[$index]);
        $v->say($phrase);
    }
}

