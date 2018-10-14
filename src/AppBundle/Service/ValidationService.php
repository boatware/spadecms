<?php
namespace AppBundle\Service;

/**
 * Service that handles several types of validation
 */
class ValidationService
{
    /**
     * Validate given Password
     * Makes sure the User is about to use a secure password
     *
     * @param $enteredPassword string
     * @param $username
     * @param $email string
     *
     * @return bool
     */
    public function validatePassword($enteredPassword, $username, $email)
    {
        // Password must include at least one uppercase letter
        $uppercase = preg_match('@[A-Z]@', $enteredPassword);

        // Password must include at least one lowercase letter
        $lowercase = preg_match('@[a-z]@', $enteredPassword);

        // Password must include at least one digit
        $number    = preg_match('@[0-9]@', $enteredPassword);

        // Password must have a length of at least 8 characters
        $length    = (strlen($enteredPassword) >= 8);

        // Password can't be the own username
        $isOwnUsername = ($enteredPassword != $username) ? 1 : 0;

        // Password can't be the own email address
        $isOwnEmail = ($enteredPassword != $email) ? 1 : 0;

        if(
            $uppercase ||
            $lowercase ||
            $number ||
            $length ||
            $isOwnUsername ||
            $isOwnEmail
        )
        {
            return true;
        }

        return false;
    }
}