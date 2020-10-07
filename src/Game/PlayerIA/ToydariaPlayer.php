<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class ToydariaPlayers
 * @package Hackathon\PlayerIA
 * @author Hamza MEBAREK
 */
class ToydariaPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------
        
        //gerer round 0
        $round = $this->result->getNbRound();
        if ($round == 0) {
            return parent::paperChoice();
        }

        $stats = $this->result->getStatsFor($this->opponentSide);
        $scissors = $stats['scissors'];
        $paper = $stats['paper'];
        $rock = $stats['rock'];

        $oppo_choices = $this->result->getChoicesFor($this->opponentSide);
        $my_choices = $this->result->getChoicesFor($this->mySide);

        $oppo_len = count($oppo_choices);
        $my_len = count($my_choices);


        if ($oppo_len > 1 && $my_len > 1) {
            $last_play = $oppo_choices[$oppo_len - 1];
            $blast_play = $oppo_choices[$oppo_len - 2];
            $my_last_play = $my_choices[$my_len - 1];

            if ($last_play == $blast_play) {
                if ($my_last_play == 'rock') {
                    return parent::rockChoice();
                }
                else if ($my_last_play == 'paper') {
                    return parent::paperChoice();
                }
                return parent::scissorsChoice();
            }
        }

        if (max($paper, $rock, $scissors) == $paper) {
            return parent::scissorsChoice();
        }

        else if(max($paper, $rock, $scissors) == $rock) {
            return parent::paperChoice();

        }
        return parent::rockChoice();
    }
};
