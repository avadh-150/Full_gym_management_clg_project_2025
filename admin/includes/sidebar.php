
<!-- Dashboard -->
<div id="sidebar"><a href="#" class="visible-phone"><i class="fas fa-home"></i> Dashboard</a>
  <ul>
    <li class="<?php if ($page == 'dashboard') {
                  echo 'active';
                } ?>"><a href="index.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>




<!-- Admin Users -->
    <li class="submenu"> <a href="#"><i class="fas fa-users"></i> <span>Manage Admin</span> <span class="label label-important">
          <?php
          include "dbcon.php";
          $sql = "SELECT * FROM admin";
          $query = $con->query($sql);
          echo "$query->num_rows"; ?> </span></a>
      <ul>
        <li class="<?php if ($page == 'admins') {
                      echo 'active';
                    } ?>"><a href="admins.php"><i class="fas fa-arrow-right"></i> List All Admins</a></li>
        <li class="<?php if ($page == 'admins-entry') {
                      echo 'active';
                    } ?>"><a href="admins-entry.php"><i class="fa-solid fa-user-plus"></i> Admins Entry </a></li>
        <li class="<?php if ($page == 'admins-remove') {
                      echo 'active';
                    } ?>"><a href="remove-admins.php"><i class="fas fa-arrow-right"></i> Remove Admins</a></li>
        <li class="<?php if ($page == 'admins-update') {
                      echo 'active';
                    } ?>"><a href="edit-admins.php"><i class="fas fa-arrow-right"></i> Update Admins Details</a></li>
      </ul>
    </li>





    <!-- Manage Users -->
    <li class="submenu"> <a href="#"><i class="fas fa-user-check"></i><span>Manage Users</span> <span class="label label-important">
          <?php
          include "dbcon.php";
          $sql = "SELECT * FROM users";
          $query = $con->query($sql);
          echo "$query->num_rows"; ?></span></a>
      <ul>
        <li class="<?php if ($page == 'users') {
                      echo 'active';
                    } ?>"><a href="users.php"><i class="fas fa-arrow-right"></i> List All Users</a></li>
        <li class="<?php if ($page == 'users-entry') {
                      echo 'active';
                    } ?>"><a href="users-entry.php"><i class="fa-solid fa-user-plus"></i> Users Entry Form</a></li>

        <li class="<?php if ($page == 'users-update') {
                      echo 'active';
                    } ?>"><a href="update-users.php"><i class="fas fa-arrow-right"></i> Update Users Details</a></li>
      </ul>
    </li>





<!-- Gym Product -->
    <li class="submenu"> <a href="#"><i class="fas fa-dumbbell"></i> <span>Gym Products</span> <span class="label label-important">
          <?php
          include "dbcon.php";
          $sql = "SELECT * FROM products";
          $query = $con->query($sql);
          echo "$query->num_rows"; ?> </span></a>
      <ul>
        <li class="<?php if ($page == 'product_categories') {
                      echo 'active';
                    } ?>"><a href="product_categories.php"><i class="fas fa-arrow-right"></i>All Categories</a></li>
        <li class="<?php if ($page == 'products') {
                      echo 'active';
                    } ?>"><a href="products.php"><i class="fas fa-arrow-right"></i> List Products</a></li>
        <li class="<?php if ($page == 'product-entry') {
                      echo 'active';
                    } ?>"><a href="product-entry.php"><i class="fas fa-arrow-right"></i> Products Entry </a></li>


      </ul>



<!-- Manage Members -->
<li class="submenu"> <a href="#"><i class="fas fa-users"></i> <span>Manage Members</span> <span class="label label-important"><?php 
include "dbcon.php";
$sql = "SELECT * FROM users where role='member_user'";
$query = $con->query($sql);
echo "$query->num_rows";
?> </span></a>
      <ul>
        <li class="<?php if ($page == 'members') {
                      echo 'active';
                    } ?>"><a href="members.php"><i class="fas fa-arrow-right"></i> List All Members</a></li>

        <li class="<?php if ($page == 'active-members') {
                      echo 'active';
                    } ?>"><a href="active-members.php"><i class="fas fa-arrow-right"></i> Active Members</a></li>

        <li class="<?php if ($page == 'expire-members') {
                      echo 'active';
                    } ?>"><a href="expire-member.php"><i class="fas fa-arrow-right"></i> Expire Members</a></li>

<li class="<?php if ($page == 'trainer-assing') {
                  echo 'active';
                } ?>"><a href="trainer-assing.php"><i class="fas fa-arrow-right"></i>Assinging Trainers</a></li>
        <li class="<?php if ($page == 'payment_membership') {
                      echo 'active';
                    } ?>"><a href="payment_membership.php"><i class="fas fa-arrow-right"></i> Members Payment</a></li>
      </ul>
    </li>



<!-- Order And Payment -->
    <li class="submenu"> <a href="#"><i class="fa-solid fa-truck"></i> <span>Order & Payment</span> <span class="label label-important">
          <?php
          include "dbcon.php";
          $sql = "SELECT * FROM orders";
          $query = $con->query($sql);
          echo "$query->num_rows"; ?> </span>
          
          <span class="label label-important"><?php  include "dbcon.php";
          // $sql1 = "SELECT * FROM payments";
          // $query1 = $con->query($sql1);
          //echo "$query1->num_rows"; ?></span>
        </a>
          
      <ul>

        <li class="<?php if ($page == 'orders') {
                      echo 'active';
                    } ?>"><a href="orders.php"><i class="fas fa-arrow-right"></i> Orders </a></li>
        <li class="<?php if ($page == 'product_payments') {
                      echo 'active';
                    } ?>"><a href="product_payments.php"><i class="fas fa-arrow-right"></i> Payemnts </a></li>

      </ul>
    </li>

  </li>
  
  <!-- schedule   -->

    <li class="submenu"> <a href="#"><i class="fa-solid fa-calendar-days"></i> <span>Manage Schedule</span> 
        </a>
          
      <ul>  <li class="<?php if ($page == 'schedules') {
          echo 'active';
        } ?>"><a href="schedules.php"><i class="fas fa-arrow-right"></i> Schedule Entry </a></li>


        <li class="<?php if ($page == 'view_schedule') {
                      echo 'active';
                    } ?>"><a href="view_schedule.php"><i class="fas fa-arrow-right"></i> View Schedules </a></li>
        
      </ul>
    </li>

  </li>



   <li class="submenu"> <a href="#"><i class="fas fa-hand-holding-usd"></i> <span>Manage Plan</span> <span class="label label-important">
          <?php
          include "dbcon.php";
          $sql = "SELECT * FROM membership_plans";
          $query = $con->query($sql);

          echo "$query->num_rows"; ?> </span></a>
      <ul>
        <li class="<?php if ($page == 'plans') {
                      echo 'active';
                    } ?>"><a href="plans.php"><i class="fas fa-arrow-right"></i> List All Plans</a></li>
        <li class="<?php if ($page == 'plans-entry') {
                      echo 'active';
                    } ?>"><a href="plans-entry.php"><i class="fas fa-arrow-right"></i> Plans Entry Form</a></li>

      </ul>
    </li>

    <!-- Staffs -->
    <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span>Trainer Management</span> <span class="label label-important"><?php include 'dashboard-equipcount.php'; ?> </span></a>
  <ul>
    <li class="<?php if ($page == 'staffs') {
                  echo 'active';
                } ?>"><a href="staffs.php"><i class="fas fa-arrow-right"></i> Trainers</a></li>
  
    <li class="<?php if ($page == 'set-trainer-table') {
                  echo 'active';
                } ?>"><a href="set-trainer-table.php"><i class="fas fa-arrow-right"></i>Set Trainers Schedule</a></li>
    
  </ul>
</li>




    <li class="<?php if ($page == 'announcement') {
                  echo 'active';
                } ?>"><a href="announcement.php"><i class="fa-solid fa-bell"></i> <span>Announcement</span></a>
                </li>




   
             <li class="submenu"> <a href="#"><i class="fa-solid fa-book"></i> <span>Manage Blogs</span> <span class="label label-important">
          <?php
          include "dbcon.php";
          $sql = "SELECT * FROM gym_blogs";
          $query = $con->query($sql);
          echo "$query->num_rows"; ?> </span></a>
      <ul>
        <li class="<?php if ($page == 'blogs') {
                      echo 'active';
                    } ?>"><a href="blogs.php"><i class="fas fa-arrow-right"></i> List All Blogs</a></li>
        <li class="<?php if ($page == 'admins-entry') {
                      echo 'active';
                    } ?>"><a href="blogs-entry.php"><i class="fa-solid fa-user-plus"></i> Blogs Entry </a></li>
        
      </ul>
    </li>






    <li class="<?php if ($page == 'reply') {
                  echo 'active';
                } ?>"><a href="contact_replay.php"><i class="fas fa-question"></i> <span>Query Reply</span> <span class="label label-important">
          <?php
          include "dbcon.php";
          $sql = "SELECT * FROM contact where is_read=0";
          $query = $con->query($sql);

          echo "$query->num_rows"; ?> </span></a></li>






  </ul>
</div>