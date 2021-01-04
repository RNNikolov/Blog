window._ = require('lodash');

let notifications = [];

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '082dd1d1a0c028b51d12',
    cluster: 'eu',
    encrypted: true
});

const NOTIFICATION_TYPES = {
    follow: 'App\\Notifications\\UserFollowed',
    newPost: 'App\\Notifications\\NewPost'
};

$(document).ready(function () {
    // check if there's a logged in user
    if (Laravel.userId) {
        $.get('/notifications', function (data) {
            addNotifications(data, "#notifications");
        });

        window.Echo.private(`App.Models.User.${Laravel.userId}`)
            .notification((notification) => {
                addNotifications([notification], '#notifications');
            });
    }
});

// add new notifications
function addNotifications(newNotifications, target) {
    notifications = _.concat(notifications, newNotifications);
    // show only last 5 notifications
    notifications.slice(0, 5);
    showNotifications(notifications, target);
}

// show notifications
function showNotifications(notifications, target) {
    if (notifications.length) {
        var htmlElements = notifications.map(function (notification) {
            return makeNotification(notification);
        });
        $(target + 'Menu').html(htmlElements.join(''));
        $(target).addClass('has-notifications')
    } else {
        $(target + 'Menu').html('<li class="dropdown-header">No notifications</li>');
        $(target).removeClass('has-notifications');
    }
}

// create a notification li element
function makeNotification(notification) {
    var to = routeNotification(notification);
    var notificationText = makeNotificationText(notification);
    return `<li><a href="${to}" class="dropdown-item">${notificationText}</a></li>`;
}

// get the notification route based on it's type
function routeNotification(notification) {
    var to = `?read=${notification.id}`;
    if (notification.type === NOTIFICATION_TYPES.follow) {
        to = 'users' + to;
    } else if (notification.type === NOTIFICATION_TYPES.newPost) {
        const postId = notification.data.post_id;
        to = `posts/${postId}` + to;
    }
    return '/' + to;
}

// get the notification text based on it's type
function makeNotificationText(notification) {
    var text = '';
    if (notification.type === NOTIFICATION_TYPES.follow) {
        const name = notification.data.follower_name;
        text += `<strong>${name}</strong> followed you`;
    } else if (notification.type === NOTIFICATION_TYPES.newPost) {
        const name = notification.data.following_name;
        text += `<strong>${name}</strong> published a post`;
    }
    return text;
}





