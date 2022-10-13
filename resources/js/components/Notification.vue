<template>
  <li class="nav-item dropdown notification-body">
    <a
      class="dropdown-toggle"
      href="#"
      id="navbarDropdown"
      role="button"
      data-toggle="dropdown"
    >
      <i class="fa fa-bell"></i>
      <span class="badge badge-danger" v-if="unreadNotifications.length > 9"
        >9+</span
      >
      <span class="badge badge-danger" v-else>{{
        unreadNotifications.length
      }}</span>
    </a>

    <!-- Notification Body -->
    <div
      class="dropdown-menu notification-body_dd mt-0"
      aria-labelledby="navbarDropdown"
    >
      <div class="notification-body_dd-header d-flex justify-content-between">
        <h4 class="text-center">
          <i class="fa fa-bell text-warning"></i>
          Notifications
        </h4>
        <span class="text-primary" @click="markAllAsRead"
          ><i class="fa fa-paint-brush" aria-hidden="true"></i> Mark as all
          read</span
        >
      </div>
      <div
        class="notification-body_dd-content"
        v-for="(notification, id) in unreadNotifications"
        :key="id"
      >
        <a
          class="notification-list notification-list--unread text-dark"
          @click="redirect(notification)"
        >
          <div class="notification-list_img">
            <img :src="`${assets}/notification.png`" />
          </div>
          <div class="notification-list_detail">
            <p class="nt-link">
              <b> {{ notification.data.name }}</b>
              {{ notification.data.description }}
              {{ notification.data.icon }}
            </p>
            <p>
              <span class="text-muted"> {{ notification.data.service }}</span>
            </p>
          </div>
          <p>
            <small>{{ notifiedTime(notification.created_at) }}</small>
          </p>
        </a>
      </div>
    </div>
  </li>
</template>

<script>
export default {
  mounted() {
    this.getNotifications();
    this.interval = setInterval(
      function () {
        this.getNotifications();
      }.bind(this),
      30000
    );
  },
  data() {
    return {
      unreadNotifications: {},
      assets: window.asset_url,
    };
  },
  methods: {
    notifiedTime(time) {
      return this.$moment(time).fromNow();
    },

    getNotifications() {
      axios
        .get("/app/notifications")
        .then((response) => {
          this.unreadNotifications = response.data.data;
        })
        .catch((errors) => {});
    },

    markAllAsRead() {
      axios
        .post(`/app/notifications/mark-all-read`)
        .then((response) => {
          this.getNotifications();
        })
        .catch((errors) => {});
    },

    markAsRead(id) {
      axios
        .post(`/app/notifications/${id}/mark-as-read`)
        .then((response) => {
          this.getNotifications();
        })
        .catch((errors) => {
          console.log(errors);
        });
    },

    redirect(notification) {
      let id = notification.id;
      if (notification.data.target) {
        this.markAsRead(id);
        location.href = notification.data.target;
      } else {
        this.markAsRead(id);
      }
    },
  },
};
</script>

<style scoped>
.badge {
  height: 1rem;
  width: 1rem;
  border-radius: 50%;
  padding-bottom: 0;
  font-size: 10px;
  right: 6px;
}

.badge-danger {
  color: rgb(245, 237, 237);
  background-color: #cd201f;
  border: none;
}

.notification-list .notification-list_detail .nt-link {
  border-left: 3px solid #183d64;
}

.dropdown-menu {
  max-height: 58vh;
  overflow-y: auto;
}

a {
  text-decoration: none;
}
</style>
