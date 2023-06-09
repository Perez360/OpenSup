<?php
$userControllers = new ControllerGroup();
$userControllers->setGroupPath('/user');
require 'user/get-tickets.php';

$userControllers->addController(new LoginController);
$userControllers->addController(new SignUpController);
$userControllers->addController(new InviteUserController);
$userControllers->addController(new LogoutController);
$userControllers->addController(new CheckSessionController);
$userControllers->addController(new SendRecoverPasswordController);
$userControllers->addController(new RecoverPasswordController);
$userControllers->addController(new EditPassword);
$userControllers->addController(new EditEmail);
$userControllers->addController(new GetUserController);
$userControllers->addController(new GetUsersController);
$userControllers->addController(new GetUserByIdController);
$userControllers->addController(new DeleteUserController);
$userControllers->addController(new BanUserController);
$userControllers->addController(new UnBanUserController);
$userControllers->addController(new ListBanUserController);
$userControllers->addController(new VerifyController);
$userControllers->addController(new EnableUserController);
$userControllers->addController(new DisableUserController);
$userControllers->addController(new EditCustomFieldsController);
$userControllers->addController(new EditSupervisedListController);
$userControllers->addController(new GetSupervisedTicketController);
$userControllers->addController(new ResendEmailTokenController);
$userControllers->addController(new GetUserTicketController);

$userControllers->addController(new ResendInviteUserController);

$userControllers->finalize();
