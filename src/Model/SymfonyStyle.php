<?php

namespace Adamski\Symfony\UtilsBundle\Model;

use Symfony\Component\Console\Style\SymfonyStyle as BaseSymfonyStyle;

class SymfonyStyle extends BaseSymfonyStyle {

    /**
     * Display task starting information with provided message.
     *
     * @param string $message
     */
    public function taskStart(string $message) {
        $this->writeln(
            sprintf(" ➤ %s", $message)
        );
    }

    /**
     * Display information about the task that will be processed.
     *
     * @param string $message
     */
    public function taskProcess(string $message) {
        $this->writeln(
            sprintf(" .. %s", $message)
        );
    }

    /**
     * Successfully finish previous task.
     * This function replace arrow icon from previous task with check icon.
     */
    public function taskEnd() {
        $this->writeln("\r\033[K\033[1A\r <info>✔</info>");
    }

    /**
     * Finish previous task with error.
     * This function replace arrow icon from previous task with cross icon.
     */
    public function taskError() {
        $this->writeln("\r\033[K\033[1A\r <fg=yellow>✘</fg=yellow>");
    }

    /**
     * Successfully finish previous task.
     * This function don't integrate into previous task message
     * Just add new line with provided message and check icon.
     *
     * @param string $message
     */
    public function taskSuccess(string $message = "Done") {
        $this->writeln(
            sprintf(" <info>✔ %s</info>", $message)
        );
    }

    /**
     * Display success information with provided message.
     *
     * @param string $message
     */
    public function writeInfo(string $message) {
        $this->writeln(
            sprintf(" <info>%s</info>", $message)
        );
    }

    /**
     * Display error information with provided message.
     *
     * @param string $message
     */
    public function writeError(string $message) {
        $this->writeln(
            sprintf(" <error>%s</error>", $message)
        );
    }

    /**
     * Display warning information with provided message.
     *
     * @param string $message
     */
    public function writeWarning(string $message) {
        $this->writeln(
            sprintf(" <comment>%s</comment>", $message)
        );
    }

    /**
     * Display message and status.
     * The space between will be completed with the right number of characters.
     *
     * @param string $message
     * @param string $status
     * @param string $spaceChar
     * @param int    $messageMax
     * @param bool   $spaceBefore
     * @param bool   $spaceAfter
     */
    public function writeStatus(string $message, string $status, string $spaceChar = ".", int $messageMax = 100, bool $spaceBefore = true, bool $spaceAfter = true) {
        $messageMax -= true === $spaceBefore ? 1 : 0;
        $messageMax -= true === $spaceAfter ? 1 : 0;
        $messageMax = $messageMax > 0 ? $messageMax : 0;

        // Return part of a string
        $message = "    " . $message;
        $message = substr($message, 0, $messageMax);

        // Calculate number of marks to insert
        $markCount = $messageMax - strlen($message);
        $markCount = $markCount > 0 ? $markCount : 0;

        // Compose final message
        $finalMessage = $message;
        $finalMessage .= true === $spaceBefore ? " " : "";
        $finalMessage .= str_repeat($spaceChar, $markCount);
        $finalMessage .= true === $spaceAfter ? " " : "";
        $finalMessage .= $status;

        // Write message
        $this->writeln($finalMessage);
    }

    /**
     * Display title section with current date.
     *
     * @param string $title
     * @param bool   $uppercase
     * @param string $dateFormat
     */
    public function writeTitle(string $title, bool $uppercase = true, string $dateFormat = "l jS \of F Y H:i:s") {

        // Define variables
        $prefix = "Running date:";
        $runningDate = date($dateFormat);

        // Uppercase content if required
        $title = true === $uppercase ? mb_strtoupper($title) : $title;
        $prefix = true === $uppercase ? mb_strtoupper($prefix) : $prefix;
        $runningDate = true === $uppercase ? mb_strtoupper($runningDate) : $runningDate;

        // Write content
        $this->title($title);
        $this->text($prefix . " " . $runningDate);
        $this->newLine();
    }
}
