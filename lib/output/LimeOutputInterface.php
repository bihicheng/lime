<?php

/*
 * This file is part of the Lime test framework.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) Bernhard Schussek <bernhard.schussek@symfony-project.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

/**
 * Specifies how the results of an executed test should be presented.
 *
 * The class LimeTest uses an output to communicate the results of a test to
 * the user or to a different application. All outputs must implement this
 * interface.
 *
 * One output instance may receive test results of one or many test files.
 * Each time when the output switches context between one test file and
 * another, the method focus() is called with the name of the new test file.
 * Once the file has been processed completely, the method close() is called
 * to allow the output to finalize the results for the active test script.
 *
 * Depending on whether the output supports threading (parallel inputs from
 * different actively tested files) the method supportsThreading() should
 * return TRUE or FALSE.
 *
 * @package    Lime
 * @author     Bernhard Schussek <bernhard.schussek@symfony-project.com>
 * @version    SVN: $Id: LimeOutputInterface.php 23701 2009-11-08 21:23:40Z bschussek $
 */
interface LimeOutputInterface
{
  /**
   * Returns whether this output supports processing results from different tests
   * simultaneously.
   *
   * @return boolean
   */
  public function supportsThreading();

  /**
   * Focuses the output on the given test file.
   *
   * All inputs until the next call to focus() concern this test file.
   *
   * @param string$file
   */
  public function focus($file);

  /**
   * Closes the output for the currently focused test file.
   */
  public function close();

  /**
   * Informs the output about a successful test.
   *
   * @param  string  $message  The test message
   * @param  string  $file     The file in which the successful test occured
   * @param  integer $line     The line of the file
   */
  public function pass($message, $class, $time, $file, $line);

  /**
   * Informs the output about a failed test.
   *
   * @param  string     $message  The test message
   * @param  LimeError  $error    The reason why the test failed
   */
  public function fail($message, $class, $time, $file, $line, LimeError $error = null);

  /**
   * Informs the output about a skipped test.
   *
   * @param  string  $message  The test message
   * @param  string  $file     The file in which the skipped test occured
   * @param  integer $line     The line of the file
   */
  public function skip($message, $class, $time, $file, $line, $reason = '');

  /**
   * Informs the output about a todo.
   *
   * @param  string  $message  The todo message
   * @param  string  $file     The file in which the todo occured
   * @param  integer $line     The line of the file
   */
  public function todo($message, $class, $file, $line);

  /**
   * Informs the output about an error.
   *
   * @param LimeError $error  The error that occurred
   */
  public function error(LimeError $error);

  /**
   * Informs the output about a comment.
   *
   * @param  string  $message  The comment message
   */
  public function comment($message);

  /**
   * Flushes the test outputs to the console.
   */
  public function flush();

  /**
   * Returns whether the overall tests were successful.
   */
  public function success();
}