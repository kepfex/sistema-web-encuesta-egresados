<div x-data="{
    notifications: [],
    displayDuration: 4000,
    soundEffect: false,

    addNotification({ variant = 'info', sender = null, title = null, message = null }) {
        const id = Date.now()
        const notification = { id, variant, sender, title, message }

        // Keep only the most recent 20 notifications
        if (this.notifications.length >= 20) {
            this.notifications.splice(0, this.notifications.length - 19)
        }

        // Add the new notification to the notifications stack
        this.notifications.push(notification)

        if (this.soundEffect) {
            // Play the notification sound
            const notificationSound = new Audio('https://res.cloudinary.com/ds8pgw1pf/video/upload/v1728571480/penguinui/component-assets/sounds/ding.mp3')
            notificationSound.play().catch((error) => {
                console.error('Error playing the sound:', error)
            })
        }
    },
    removeNotification(id) {
        setTimeout(() => {
            this.notifications = this.notifications.filter(
                (notification) => notification.id !== id,
            )
        }, 400);
    },
}"

    x-on:notify.window="addNotification({
                variant: $event.detail.variant,
                sender: $event.detail.sender,
                title: $event.detail.title,
                message: $event.detail.message,
        })">

    <div x-on:mouseenter="$dispatch('pause-auto-dismiss')" x-on:mouseleave="$dispatch('resume-auto-dismiss')"
        class="group pointer-events-none fixed inset-x-8 top-0 z-99 flex max-w-full flex-col gap-2 bg-transparent px-6 py-6 md:bottom-0 md:left-[unset] md:right-0 md:top-[unset] md:max-w-sm">
        <template x-for="(notification, index) in notifications" x-bind:key="notification.id">
            <!-- root div holds all of the notifications  -->
            <div>
                <!-- Success Notification  -->
                <template x-if="notification.variant === 'success'">
                    <div x-data="{ isVisible: false, timeout: null }" x-cloak x-show="isVisible"
                        class="pointer-events-auto relative rounded-radius border border-success bg-surface text-on-surface dark:bg-surface-dark dark:text-on-surface-dark"
                        role="alert" x-on:pause-auto-dismiss.window="clearTimeout(timeout)"
                        x-on:resume-auto-dismiss.window=" timeout = setTimeout(() => {(isVisible = false), removeNotification(notification.id) }, displayDuration)"
                        x-init="$nextTick(() => { isVisible = true }), (timeout = setTimeout(() => { isVisible = false, removeNotification(notification.id) }, displayDuration))" x-transition:enter="transition duration-300 ease-out"
                        x-transition:enter-end="translate-y-0" x-transition:enter-start="translate-y-8"
                        x-transition:leave="transition duration-300 ease-in"
                        x-transition:leave-end="-translate-x-24 opacity-0 md:translate-x-24"
                        x-transition:leave-start="translate-x-0 opacity-100">
                        <div
                            class="flex w-full items-center gap-2.5 bg-success/10 rounded-radius p-4 transition-all duration-300">

                            <!-- Icon -->
                            <div class="rounded-full bg-success/15 p-0.5 text-success" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="size-5" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>

                            <!-- Title & Message -->
                            <div class="flex flex-col gap-2">
                                <h3 x-cloak x-show="notification.title" class="text-sm font-semibold text-success"
                                    x-text="notification.title"></h3>
                                <p x-cloak x-show="notification.message" class="text-pretty text-sm"
                                    x-text="notification.message"></p>
                            </div>

                            <!--Dismiss Button -->
                            <button type="button" class="ml-auto" aria-label="dismiss notification"
                                x-on:click="(isVisible = false), removeNotification(notification.id)">
                                <svg xmlns="http://www.w3.org/2000/svg viewBox="0 0 24 24 stroke="currentColor"
                                    fill="none" stroke-width="2" class="size-5 shrink-0" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </template>
    </div>
</div>
