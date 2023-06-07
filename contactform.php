<?php
include 'auth.php';
require_once 'vendor/autoload.php';

if (isset($_POST['submit'])){
// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.hostinger.com', 587, 'tls'))
  ->setUsername(EMAIL)
  ->setPassword(PASS)
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('New Contact Message from:  '.$_POST['name']))
  ->setFrom(['website@derwaza.tech'])
  ->setTo(['sultan@derwaza.tech'])
  ->setBody('<h1>Here is the message itself work yay!</h1>')
  ->addCc('luqman@derwaza.tech')
  ->addPart('<table>
  <thead>
      <tr>
          <th style="background-color:#7C2EAA; color:#ffffff; text-align:center; border: 1px solid #7c2eaa; padding:4px;"
colspan="4">New Contact Message</th>
      </tr>
  </thead>
  <tbody>
      <tr>
          <td style="padding:4px; color:#7C2EAA; font-weight:bold; border:1px solid black;">Client Name:</td>
          <td style="padding:4px; border:1px solid black; ">'.$_POST['name'].'</td>
      </tr>
    <tr>
 <td style="padding:4px; color:#7C2EAA; font-weight:bold; border:1px solid black;">Email:</td>
          <td style="border:1px solid black; padding:4px;">'.$_POST['email'].'</td>
      </tr>

 <tr>
           <td  style="padding:4px; color:#7C2EAA; font-weight:bold; border:1px solid black; ">Message:</td>
          <td  style="border:1px solid black; padding:4px;">'.$_POST['message'].'</td>
</tr>
  </tbody>
</table>
', 'text/html');

// Send the messag
if($mailer->send($message)){
    header("Location: index.php?mailsend");
}
else {
    echo "failed";
}}