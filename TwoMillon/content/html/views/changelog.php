]<?php 

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: /");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="An online platform to test and advance your skills in penetration testing and cyber security." />
    <meta property="og:title" content="Change Log" />
    <meta property="og:image" content="/images/favicon.png" />
    <meta property="og:site_name" content="Hack The Box" />
    <meta property="og:description" content="An online platform to test and advance your skills in penetration testing and cyber security." />

    <!-- Page title -->
    <title>Hack The Box :: Change Log </title>

    <!-- styles -->
    <link rel="stylesheet" href="/css/htb-backend.css"/>
    <link rel="stylesheet" href="/css/animate.css"/>
    <link rel="icon" href="/images/favicon.png">
</head>
<body>
<!-- Wrapper-->
<div class="wrapper">
    <!-- Navigation-->
    <?php
        include("header.php");
        include("navigation.php");
    ?>

    <!-- Main content-->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
                        <div class="pull-right text-right" style="line-height: 14px">
                            <small>Hack The Box<br>Change Log<br> <span class="c-white">1.2.8</span></small>
                        </div>
                        <div class="header-icon">
                            <i class="pe page-header-icon pe-7s-note"></i>
                        </div>
                        <div class="header-title">
                            <h3 class="m-b-xs">Change Log</h3>
                            <small>
                                Change logs and general notices.
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
            <h3>Version 1.0.2 [5-9-2017]</h3>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Machine Status</span><br>
                Status of the machine (online/offline) is now invoked with a button on the Machines list and Retired list.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Resets</span><br>
                VIP Members will now have unlimited resets to their respective lab servers.
            </p>
            <p>
                <span class="text-warning">[!]</span> <span class="c-white">Bug: Rank not updating [reported by <a href="#">P1rs1ng6407</a>]</span><br>
                Rank sometimes did not update after machine/challenge owns. This happened because of a millisecond delay of writing the challenge own and the firing of rank recalculation. As a workaround rank is also calculated hourly.
            </p>
            <p>
                <span class="text-warning">[!]</span> <span class="c-white">Bug: Top 100 Badge</span><br>
                Top 100 Badge was not always given to users. A scheduled job was added to calculate and fix badge errors after HoF updates.
            </p>
            <br>
            <br>
            <h3>Version 1.0.1 [4-9-2017]</h3>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: XP Bars [feedback from <a href="#">kernelv0id</a>]</span><br>
                The progress towards the next rank will be displayed at each user's profile. If the user has dropped requirements for current rank, the progress bar will remain at 0% and then continue building up when the user fulfils the requirements again.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Addition: VIP Status</span><br>
                VIP Member profiles are now identified by a star next to their name.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Addition: More Top Badges [feedback from <a href="#">megapolska</a>]</span><br>
                Badges will now be given for top 25, top 50 and top 100 of HoF.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Addition: Completionist Badge [feedback from <a href="#">Arrexel</a>]</span><br>
                A badge will be given when a user reaches 100% completion (machines and challenges) at any point.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Reset Notifications</span><br>
                Reset and cancel notifications are now displayed only to the users of the relevant lab.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: UI Pre-loading</span><br>
                Pre-loading of the UI (green progress bar) has been disabled for better performance.
            </p>
            <p>
                <span class="text-warning">[!]</span> <span class="c-white">Bug: Team Rankings Chart Error [reported by <a href="#">eks</a>]</span><br>
                Team rankings chart was showing erroneous rankings while the table below was displaying rankings correctly. This was a visual bug that has been fixed.
            </p>
            <br>
            <br>

            <h3>Version 1.0.0 [28-8-2017]</h3>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: VIP Subscriptions</span><br>
                Donations have been substituted by VIP Subscriptions that will include several perks including semi-private labs with cap on maximum users and bigger retention of Retired boxes online.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Multi-VPN</span><br>
                Multiple VPN servers with access to different lab instances are now available. Current load on each member's VPN is displayed at the top-left part of the sidebar.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Second Machine Maker</span><br>
                Machines can now have two makers instead of one in case the machine is made in cooperation with someone. For now the second maker is only added manually by HTB.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Self Service VPN Keys Reissuing</span><br>
                Users are now able to revoke and re-issue their VPN keys from the access page.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Shoutbox/Infobox</span><br>
                Shouts will now be delivered by web socket push requests instead of auto-refreshing every 3 seconds.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Private Messages</span><br>
                Private messages will only work through HTB-Cli from now on. /msg command in shoutbox is removed.
            </p>
            <p>
                <span class="text-warning">[!]</span> <span class="c-white">Bug: Editor/Add new Link [reported by <a href="#">TwelveSec</a>]</span><br>
                The checkbox "Open in new Tab" on the Job Offer editor's "Add Link" was changing states but the state changes were not reflected in the UI.
            </p>
            <p>
                <span class="text-danger">[*]</span> <span class="c-white">Security Bug: Information Disclosure [reported by <a href="#">kernelv0id</a>]</span><br>
                After migrating to new servers for the web platform, a directive was left as default disclosing the web server version and OS flavor.
            </p>
            <br>
            <br>
            <h3>Version 0.9.3 [11-8-2017]</h3>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Job Offers</span><br>
                Aggregate listing of job offers from all companies is now available through the side-menu.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: E-Mail Notifications</span><br>
                Users will be notified by email on career and contact requests, machine releases and other important info regarding Hack The Box platform. There is an option under Settings to opt-out of e-mail notifications.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Account Deletion</span><br>
                In order to delete your account now you should type in a wording to avoid deleting it by crawling the site as an authenticated user. (not that you should be crawling the website at the first place but ok...)
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Resets</span><br>
                Resets increased by +1 for each rank so Noob rank now has 1 reset to start with.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: UI</span><br>
                Account settings and info have been moved on the top-right. By clicking your avatar you get a pop-up menu with all available options.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Daily Scheduled Resets</span><br>
                All machines will be rebooted every day at midnight to ensure proper operation.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Completion Percentage</span><br>
                Completion percentage will be calculated only from Active machines and Challenges since users on Free server will not be able to compete VIP users if Retried machines count to it.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Points</span><br>
                Makers will auto-own the machine after the first three bloods and get points as all other members.
            </p>
            <p>
                <span class="text-warning">[!]</span> <span class="c-white">Bug: Top10 Badge given to non-top10 users [reported by <a href="#">SirenCeol</a>]</span><br>
                Some users received the top10 badge without being even close to the Top 10. We have found something in the code that could suggest such behaviour and amended accordingly. Badges in error were removed.
            </p>
            <p>
                <span class="text-warning">[!]</span> <span class="c-white">Bug: OVPN Cert Generation Failure [reported by <a href="#">andrewn</a>]</span><br>
                If a user used an email > 40 chars long, the certificate for .ovpn file failed to generate. Proper protection mechanisms have been added to user registration form.
            </p>
            <br>
            <br>
            <h3>Version 0.9.2 [16-7-2017]</h3>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Career Opportunities</span><br>
                There is a new section on the side menu called Careers. It will be populated by Job offerings and affiliated companies in time. There is also an option to opt-in for career opportunities under "Looking for Job?" side link.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Member/Team Badges</span><br>
                You can now get a dynamically updated badge to include in your blog or forum posts. The code snippet is available to each member's or team's profile by clicking the <small><button class="btn btn-xs btn-info text-info">Get Badge</button></small> button.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Machine Rating Reminder [feedback from <a href="#">Arrexel</a>]</span><br>
                You will see a small icon (<i class="fa fa-exclamation-circle text-warning"></i>) next to the name of each machine on the Machines List when you own the machine but have not yet rated it as a reminder to do so.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Challenge Instances</span><br>
                Challenges that spawn instances, like Web or Pwn will now have an auto-destroy timeout, meaning once a challenge instance is spawned, it will self-destruct after 180 minutes. When that happens you can respawn a new one. This is done to save server resources.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Badge Ranking [feedback from <a href="#">m4lv0id</a>]</span><br>
                User Badges will now display also the position of the user in HoF.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Experimental Ads</span><br>
                We added experimentally ads in the invite and login pages. We will run them for one month and monitor results. If we see that having ads in those pages generate a decent amount of income that will assist in running costs we will keep them. However we will keep the inside of the platform ad-free.
            </p>
            <p>
                <span class="text-warning">[!]</span> <span class="c-white">Bug: Double Connection Pack [reported by <a href="#">game0ver</a>]</span><br>
                By performing some specific actions a user was able to have two active connection packs. This was resolved.
            </p>
            <br>
            <br>
            <h3>Version 0.9.1 [10-7-2017]</h3>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Point Breakdown</span><br>
                A link has been added next to each ranked member's and team's points (<i class="fa fa-info-circle text-success"></i>) in Hall of Fame that includes a breakdown of the calculation for verification purposes.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Team Management [feedback from <a href="#">m0nk3h</a>]</span><br>
                Team members can now leave a team, and team captains can now promote another member as Captain.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Team Profiles</span><br>
                Teams now have their dedicated profile pages with stats and progress.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Team Respects</span><br>
                Respect can now be given to teams through a relevant button in the Team's profile page.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Account Deletion</span><br>
                You now have the ability to delete your account if you no longer want to stay around. The relevant functionality is available at your profile settings page. Note that by deleting you will permanently loose access to your account and all your personal details will be filled with dummy data.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Machine Rating buttons</span><br>
                Machines can now be rated by the relevant buttons in each machines profile. Note that the buttons are only visible if you own root in the specific machine.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Team Rankings</span><br>
                Team rankings now follow the same principle as the Hall of Fame rankings. Note that as user rankings, team rankings are also updated hourly and not real-time.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Team Points</span><br>
                Team points follow the same principle as the user points with the difference that owns and challenge solves count as unique per team. Also, from each machine that the team has bloods on, only the higher counts.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Bloods</span><br>
                If a member of a team gets a blood of a specific type from a machine, eg. First User Blood, the rest of the team members will not be able to own the machine until all user bloods are given. User bloods do not block Root bloods though and vice-versa.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Rank</span><br>
                Rank acquired will no longer drop when completion percentage drops. Meaning, once you get the rank eg. <span class="c-white">[Hacker]</span> for reaching completion percentage > 20%, when you drop below 20% you will still have the same rank: <span class="c-white">[Hacker]</span>
            </p>
            <p>
                <span class="text-danger">[*]</span> <span class="c-white">Security Bug [reported by <a href="#">chryzsh</a>]: Members were able to access the Docker Management app.</span><br>
                Due to a configuration error, users were able to access the Docker management app. This app is responsible for all Web and Pwn challenges.
            </p>
            <br>
            <br>
            <h3>Version 0.9.0 [29-6-2017]</h3>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Pwn & Web Container Infrastructure</span><br>
                New challenge categories are being added. The categories Pwn and Web. As those categories require server interaction, we implemented a unique instancing method where every user will play on his own server instance, not interfering with the rest. In challenges where instancing is required there is a relevant button to start and stop your personal instance.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Challenges</span><br>
                A new section is available at HTB Lab called Challenges that will contain Jeopardy style challenges on various categories. By solving those challenges in the near future, relevant stats will be displayed on profile pages.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Challenge Stats</span><br>
                Each user profile now includes his completion % in challenges.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Feedback/Suggestion Box</span><br>
                There is a new button on the top-right of every page called "Feedback". By clicking it you can send comments and suggestions to HTB staff for review.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Challenge Feedback</span><br>
                Each challenge solved now requires also a feedback on the difficulty. This feedback will be used to better rate each challenge.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Hall of Fame</span><br>
                Hall of fame now displays all members that are ranked <= 100 instead of 100 top players.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Point System</span><br>
                Challenges now count both to total points and completion percentage. Expect changes in Hall of Fame!
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Difficulty Feedback</span><br>
                User and Root owns difficulty feedback is counted separately from now on. This feedback can be viewed only in each Machines profile page.
            </p>
            <br>
            <br>
            <h3>Version 0.8.7 [8-6-2017]</h3>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Machine Submissions</span><br>
                Members can now submit machines through a relevant form visible as "New Submission" under Machines menu.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Achievements / Badges</span><br>
                Members will now be awarded badges for certain events in Hack The Box like owning difficult machines, being in certain postion in Hall of Fame etc.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Notification / Announcements Panel</span><br>
                There is an announcement section now and we will be posting there all important stuff. We will also integrate it to dashboard and possibly give info on the
                shoutbox when a new announcement is published.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Machine Profiles</span><br>
                Machines now have their own profiles with details on difficulty, owns and bloods.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: HTB-Cli</span><br>
                There is now a new component called htb-cli on the website that will replace shoutbox entirely. The htb-cli can be invoked from the bottom of the page
                and contains several commands to display info, interact with objects and interact with members.<br>
                HTB-cli has three main modes:
                <ul>
                <li><span class="text-warning">[cmd]</span>: executes several commands that can be displayed by pressing double-tab</li>
                <li><span class="text-danger">[shoutbox]</span>: can be invoked by typing <code>shoutbox</code> from <span class="text-warning">[cmd]</span> mode. Whatever typed in shoutbox mode is automatically echoed to all members as a shout.</li>
                <li><span class="text-success">[message]</span>: Can be invoked by typing <code>message &lt;username&gt;</code> from <span class="text-warning">[cmd]</span> mode and opens a one-to-one chat interface with the user.</li>
                </ul>
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Machine Lists</span><br>
                Machines now are split to three main categories:
            <ul>
                <li><span class="text-success">Active</span>: Machines that give points to advance in the Hall of Fame. The number of machines will always be 20.</li>
                <li><span class="text-success">Retired</span>: Machines that used to be active and are now retired. Retired machines dont give points but count towards the completion percentage (that acts as a multiplier for points)</li>
                <li><span class="text-success">Unreleased</span>: Machines that will be released soon.</li>
            </ul>
            </p>
            <br>
            <br>
            <h3>Version 0.8.6 [25-5-2017]</h3>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Custom Avatar</span><br>
                Members can now upload a custom avatar in 1:1 jpg or png format.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Machine Ratings</span><br>
                Machines can now be rated by members after owning root on them. The rating is in the form like/dislike and is visible on the machine list.<br>
                In order to rate a machine you have to issue the command /rate &lt;machine&gt; &lt;pro/sucks&gt;.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Machine Release Dates</span><br>
                Machines under development will be listed below Machines under Machines > List along with their Release date.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Support Shoutbox</span><br>
                Noob rank can now chat with moderators on the support channel to rapidly resolve issues.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Browser Push Notifications</span><br>
                Push notifications have been implemented and currently display all reset requests and cancellations.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: IPv6 Support</span><br>
                IPv6 is now supported on VPN and each member should get a private IPv6 address aswell. There is a known issue if your computer has IPv6 disabled and the workaround is posted in the forum.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Delayed Resets with Cancel Option</span><br>
                Resets now will have a timeout of two minutes to execute. Any user has the ability to cancel this reset within those two minutes by issuing /cancel &lt;reset_id&gt;
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Hall of Fame</span><br>
                Hall of Fame ties (same points between users) now share the same rank. For example both 3rd place or 30th place etc. Furthermore, rankings will be updated hourly and not in real-time for better performance.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Administration Delegation</span><br>
                Administrative tasks have been delegated to a number of users for more streamlined support and availability called Moderators. Moderators are identified by the <span class="text-danger">[+M]</span> flag.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Allow shouts to Script Kiddie and above</span><br>
                From now on, you will need rank Script Kiddie and above to post in the shoutbox. Private messaging and other functions will work as usual.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Ranking</span><br>
                Major Ranking system change in points awarded, including additional bonus for first three users owning a machine.<br>
                <br>
                First Global User Own will get an extra of 30% points (First Blood <i class="fa fa-tint text-danger"></i>).<br>
                Second Global User Own will get an extra of 20% points (Second Blood <i class="fa fa-tint text-warning"></i>).<br>
                Third Global User Own will get an extra of 10% points (Third Blood <i class="fa fa-tint"></i>).<br>
                <br>
                First Global Root Own will get an extra of 30%  points (First Blood <i class="fa fa-tint text-danger"></i>).<br>
                Second Global Root Own will get an extra of 20% points (Second Blood <i class="fa fa-tint text-warning"></i>).<br>
                Third Global Root Own will get an extra of 10% points (Third Blood <i class="fa fa-tint"></i>).<br>
                <br>
                <span class="text-warning">Important Notice:</span> In order for those points to be maintained a small writeup should be submitted to <a href="mailto:writeups@hackthebox.gr">writeups@hackthebox.gr</a>. In the near future those writeups will be visible to other members that owned the machine.<br>
                <br>
                <span class="c-white">Multiplier:</span> The total points of each member will be multiplied by the completion percentage giving the final score.<br>
                <br>
                <span class="c-white">Machine Decomissioning:</span> Machines will be decommisioned on a regular basis and their points will be removed from all members including 1st 2nd and 3rd bloods. Afterwards rankings will be recalculated. The machines will either then be available to play and own without points or removed depending on quality and feedback.<br>
                This will ensure that new members have the same chances with older ones on reaching no.1 in Hall of Fame.
                <br>
                <br>
                <span class="c-white">Machine Makers:</span> Makers will not be rewarded points from their own machines, although they will automatically own them after release and will count towards their ownership %.
                <br>
                <br>
                <span class="c-white">Machine Additions:</span> Machines will be added on Fridays at 19:00 UTC. Not every friday will have a machine addition but release dates will be displayed publicly in the Machines list.<br>
            </p>
            <p>
                <span class="text-danger">[*]</span> <span class="c-white">Security Bug [reported by <a href="#">CFSworks</a>]: IPv6 VPN Clients were able to connect to each other.</span><br>
                This happened because openvpn does not take into account the isolation options with IPv6. As a workaround we limited client-to-client connections through the networking stack. Note that ICMP is still allowed.
            </p>
            <br>
            <br>
            <h3>Version 0.8.5 [8-5-2017]</h3>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Public profiles</span><br>
                Each member can enable his public profile from "Settings > Make my profile public". His profile will then be publicly accessible for anyone to view without requiring him to be a member of Hack The Box.<br>
                Note that the public profile URL will be different than the usual profile page.
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Respect</span><br>
                Each member can "respect" another member by issuing a command in the shoutbox. Respect is one-off and non-revertible. The command is /respect &lt;username&gt;
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Private Messages</span><br>
                Members can send private messages to each other by issuing the command /msg in the shoutbox.The command is /message &lt;username&gt; &lt;message&gt;
            </p>
            <p>
                <span class="text-accent">[+]</span> <span class="c-white">Feature: Interactive Shoutbox</span><br>
                I am beginning to add command-line style interactivity to the shoutbox. For now there is feedback on the /respect command and also a /help command that will be populated in the future with all available commands.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Rankings</span><br>
                Rankings now are limited to members that have more than 1 points.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Username changes</span><br>
                Each member is allowed to change his username 3 times. After that, the functionality is disabled permanently. If the member requires further changes he should contact an admin.
            </p>
            <p>
                <span class="text-info">[~]</span> <span class="c-white">Change: Machine Resets</span><br>
                The number of times a member can reset a machine will be based on rank as follows:<br>
            <div class="row">
                <div class="col-md-3">
                    <table class="table table-striped small">
                        <thead>
                        <tr>
                            <th class="text-center">Rank</th>
                            <th class="text-center">Resets</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">Noob</td>
                            <td class="text-center">0</td>
                        </tr>
                        <tr>
                            <td class="text-center">Script Kiddie</td>
                            <td class="text-center">1</td>
                        </tr>
                        <tr>
                            <td class="text-center">Hacker</td>
                            <td class="text-center">2</td>
                        </tr>
                        <tr>
                            <td class="text-center">Pro Hacker</td>
                            <td class="text-center">3</td>
                        </tr>
                        <tr>
                            <td class="text-center">Elite Hacker</td>
                            <td class="text-center">4</td>
                        </tr>
                        <tr>
                            <td class="text-center">Guru</td>
                            <td class="text-center">5</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </p>
            <p>
                <span class="text-warning">[!]</span> <span class="c-white">Bug: Connection pack cannot be downloaded after username change.</span><br>
                Bug is now resolved. Every time the user changes his username, his keys will be re-generated.
            </p>
            <p>
                <span class="text-warning">[!]</span> <span class="c-white">Bug: User avatar fails to generate.</span><br>
                This happens because of timeouts from the avatar generation web service. As a workaround the avatar generation is now queued and retried on failures.
            </p>
            <p>
                <span class="text-danger">[*]</span> <span class="c-white">Security Bug [reported by <a href="#">makelarisjr</a>]: Shoutbox API information disclosure.</span><br>
                A bug in the shoutbox API could allow an individual to acquire information about other members.
            </p>
        </div>
    </section>
    <!-- End main content-->
</div>
<!-- End wrapper-->

<!--Modals-->
<!--User Modal-->
<?php
    include_once "usermodal.php";
?>

<!-- scripts -->
<script src="/js/htb-backend.min.js"></script>
</body>
</html>
