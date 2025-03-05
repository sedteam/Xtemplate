<?php

/**
 * example 6
 * demonstrates simple conditions
 */

include_once('../xtemplate.class.php');

$xtpl = new XTemplate('ex9.xtpl');

// Enable debug mode to catch errors
$xtpl->debug = true;

// Test Case 1: Young user, few posts, regular role, zero score
echo "<h2>Test Case 1: Young user, few posts, regular role, zero score</h2>";
$xtpl->assign('USERNAME', 'Alice');
$xtpl->assign('USER_AGE', 16);
$xtpl->assign('POST_COUNT', 3);
$xtpl->assign('USER_ROLE', 'user');
$xtpl->assign('USER_SCORE', 0);
$xtpl->assign('TOTAL_SCORE', 9); // 9 / 3 = 3
$xtpl->parse('MAIN');
$xtpl->out('MAIN');
$xtpl->reset('MAIN');

// Test Case 2: Adult user, moderate posts, admin role, positive score
echo "<h2>Test Case 2: Adult user, moderate posts, admin role, positive score</h2>";
$xtpl->assign('USERNAME', 'Bob');
$xtpl->assign('USER_AGE', 25);
$xtpl->assign('POST_COUNT', 15);
$xtpl->assign('USER_ROLE', 'admin');
$xtpl->assign('USER_SCORE', 10);
$xtpl->assign('TOTAL_SCORE', 45); // 45 / 15 = 3
$xtpl->parse('MAIN');
$xtpl->out('MAIN');
$xtpl->reset('MAIN');

// Test Case 3: Older user, many posts, moderator role, high score
echo "<h2>Test Case 3: Older user, many posts, moderator role, high score</h2>";
$xtpl->assign('USERNAME', 'Charlie');
$xtpl->assign('USER_AGE', 35);
$xtpl->assign('POST_COUNT', 60);
$xtpl->assign('USER_ROLE', 'moderator');
$xtpl->assign('USER_SCORE', 15);
$xtpl->assign('TOTAL_SCORE', 90); // 90 / 60 = 1.5
$xtpl->parse('MAIN');
$xtpl->out('MAIN');
$xtpl->reset('MAIN');

// Test Case 4: Edge case - exactly 18, exactly 10 posts, user role, low score
echo "<h2>Test Case 4: Edge case - exactly 18, exactly 10 posts, user role, low score</h2>";
$xtpl->assign('USERNAME', 'Dana');
$xtpl->assign('USER_AGE', 18);
$xtpl->assign('POST_COUNT', 10);
$xtpl->assign('USER_ROLE', 'user');
$xtpl->assign('USER_SCORE', 5);
$xtpl->assign('TOTAL_SCORE', 15); // 15 / 10 = 1.5
$xtpl->parse('MAIN');
$xtpl->out('MAIN');
$xtpl->reset('MAIN');

?>