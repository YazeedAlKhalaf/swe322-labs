<?php
function Input($id, $name, $type, $label, $placeholder = '', $value = '', $additionalClasses = '')
{
?>
    <div class="flex flex-col w-full mb-4">
        <label for="<?php echo $id; ?>" class="mb-1"><?php echo $label; ?></label>
        <input type="<?php echo $type; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>" class="border rounded-lg py-2 px-4 <?php echo $additionalClasses; ?>" placeholder="<?php echo $placeholder; ?>" value="<?php echo htmlentities($value); ?>" />
    </div>
<?php
}
?>

<?php
function PasswordInput($id, $name, $label, $placeholder = '', $value = '')
{
?>
    <div class="flex flex-col w-full mb-4">
        <label for="<?php echo $id; ?>" class="mb-1"><?php echo $label; ?></label>
        <div class="relative">
            <input type="password" id="<?php echo $id; ?>" name="<?php echo $name; ?>" class="border rounded-lg py-2 px-4 pr-12 w-full" placeholder="<?php echo $placeholder; ?>" value="<?php echo htmlentities($value); ?>" required />
            <span class="absolute inset-y-0 right-0 flex items-center justify-center pr-3 cursor-pointer w-10 h-10 toggle-password-visibility" data-target="<?php echo $id; ?>">
                <svg id="<?php echo $id; ?>-visibility-icon_eye-off" class="hidden" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                        <path d="M16.681 16.673A8.7 8.7 0 0 1 12 18q-5.4 0-9-6q1.908-3.18 4.32-4.674m2.86-1.146A9 9 0 0 1 12 6q5.4 0 9 6q-1 1.665-2.138 2.87M3 3l18 18" />
                    </g>
                </svg>
                <svg id="<?php echo $id; ?>-visibility-icon_eye" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0-4 0" />
                        <path d="M21 12q-3.6 6-9 6t-9-6q3.6-6 9-6t9 6" />
                    </g>
                </svg>
            </span>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordVisibility = function() {
                const passwordField = document.getElementById("<?php echo $id; ?>");
                const visibilityIconEyeOff = document.getElementById("<?php echo $id; ?>-visibility-icon_eye-off");
                const visibilityIconEye = document.getElementById("<?php echo $id; ?>-visibility-icon_eye");

                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    visibilityIconEyeOff.classList.remove('hidden');
                    visibilityIconEye.classList.add('hidden');
                } else {
                    passwordField.type = 'password';
                    visibilityIconEyeOff.classList.add('hidden');
                    visibilityIconEye.classList.remove('hidden');
                }
            };

            const toggleVisibilityButton = document.querySelector('.toggle-password-visibility[data-target="<?php echo $id; ?>"]');
            toggleVisibilityButton.addEventListener('click', togglePasswordVisibility);
        });
    </script>
<?php
}
?>