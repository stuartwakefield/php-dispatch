<?php
/* Specific type exception allows configuration exception
 * to be caught separate from exceptions that may be 
 * generated through the construction of other objects
 */
class PhinjectException extends Exception {}
?>