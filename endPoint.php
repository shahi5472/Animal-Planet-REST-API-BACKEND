<?php

/*
 * TODO end point for login, METHOD POST
 * parameter are
 * email
 * password
 * http://localhost:8080/animal_planet_raw/login.php
 */

/*
 * TODO end point for register, METHOD POST
 * parameter are
 * name
 * email
 * user_type
 * phone
 * address
 * specialists
 * password
 * http://localhost:8080/animal_planet_raw/auth/register.php
 */

/*
 * TODO end point for delete user information, METHOD POST
 * parameter is
 * id
 * http://localhost:8080/animal_planet_raw/user/deleteUser.php
 */

/*
 * TODO end point for update user information, METHOD POST
 * parameter is
 * id
 * name
 * email
 * user_type
 * phone
 * address
 * specialists
 * password
 * http://localhost:8080/animal_planet_raw/updateUser.php
 */

/*
 * TODO end point for get user profile information,
 * parameter is
 * id
 * http://localhost:8080/animal_planet_raw/user/me.php
 */

/*
 * TODO end point for get hospital list, METHOD GET
 * not parameter need
 * http://localhost:8080/animal_planet_raw/hospital/index.php
 */

/*
 * TODO end point for single information for hospital, METHOD GET
 * parameter is
 * id
 * http://localhost:8080/animal_planet_raw/hospital/view.php
 */

/*
 * TODO end point for create hospital, METHOD POST
 * parameter are
 * name
 * address
 * contact
 * http://localhost:8080/animal_planet_raw/hospital/create.php
 */

/*
 * TODO end point for update hospital information, METHOD POST
 * parameter are
 * id
 * name
 * address
 * contact
 * http://localhost:8080/animal_planet_raw/hospital/edit.php
 */

/*
 * TODO end point for delete hospital, METHOD POST
 * parameter is
 * id
 * http://localhost:8080/animal_planet_raw/hospital/delete.php
 */

/*
 * TODO end point for get all post by user with name, comments, comments replies, METHOD GET
 * no need to parameter
 * http://localhost:8080/animal_planet_raw/post/index.php
 */

/*
 * TODO end point for create post, METHOD POST
 * parameter are
 * title
 * description
 * user_id
 * http://localhost:8080/animal_planet_raw/post/create.php
 */

/*
 * TODO end point for post taken by doctor METHOD POST
 * parameter are
 * doctor_id
 * post_id
 * http://localhost:8080/animal_planet_raw/post/doctorTaken.php
 */

/*
 * TODO end point for post delete with comments, METHOD POST
 * parameter is
 * id
 * http://localhost:8080/animal_planet_raw/post/deletePost.php
 */

/*
 * TODO: end point for comment delete by comment id, Method POST
 * parameter is
 * id
 * http://localhost:8080/animal_planet_raw/comments/deleteComment.php
 */

/*
 * TODO: end point for delete comment reply by reply id, Method POST
 * parameter is
 * id
 * http://localhost:8080/animal_planet_raw/comments/deleteCommentReply.php
 */

/*
 * TODO: end point for create comment, METHOD POST
 * parameter are
 * postId
 * userId
 * message
 * http://localhost:8080/animal_planet_raw/comments/createComment.php
 */

/*
 * TODO: end point for create reply comment, METHOD POST
 * parameter are
 * commentId
 * userId
 * message
 * http://localhost:8080/animal_planet_raw/comments/createReplyComment.php
 */

/*
 * TODO: end point for create notification, METHOD POST
 * parameter are
 * userId
 * data
 * http://localhost:8080/animal_planet_raw/notification/create.php
 */

/*
 * TODO: end point for get notification by user id, METHOD GET
 * parameter is
 * userId
 * http://localhost:8080/animal_planet_raw/notification/index.php
 */