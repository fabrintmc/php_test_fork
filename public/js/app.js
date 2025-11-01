// PHP Test Application - Main JavaScript File

document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // Initialize tooltips
    initializeTooltips();
    
    // Initialize form validations
    initializeFormValidations();
    
    // Initialize auto-dismiss alerts
    initializeAlerts();
    
    // Initialize smooth scrolling
    initializeSmoothScrolling();
    
    // Initialize loading states
    initializeLoadingStates();
    
    // Initialize confirmation dialogs
    initializeConfirmationDialogs();
    
    // Initialize character counters
    initializeCharacterCounters();
    
    // Initialize AJAX forms
    initializeAjaxForms();
});

/**
 * Initialize Bootstrap tooltips
 */
function initializeTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

/**
 * Initialize form validations
 */
function initializeFormValidations() {
    // Real-time password confirmation validation
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('password_confirmation');
    
    if (passwordField && confirmPasswordField) {
        function validatePasswordMatch() {
            if (confirmPasswordField.value !== passwordField.value) {
                confirmPasswordField.setCustomValidity('As senhas não coincidem');
                confirmPasswordField.classList.add('is-invalid');
            } else {
                confirmPasswordField.setCustomValidity('');
                confirmPasswordField.classList.remove('is-invalid');
                if (confirmPasswordField.value.length > 0) {
                    confirmPasswordField.classList.add('is-valid');
                }
            }
        }
        
        passwordField.addEventListener('input', validatePasswordMatch);
        confirmPasswordField.addEventListener('input', validatePasswordMatch);
    }
    
    // Email validation
    const emailFields = document.querySelectorAll('input[type="email"]');
    emailFields.forEach(function(field) {
        field.addEventListener('blur', function() {
            if (this.value && !isValidEmail(this.value)) {
                this.setCustomValidity('Por favor, insira um email válido');
                this.classList.add('is-invalid');
            } else {
                this.setCustomValidity('');
                this.classList.remove('is-invalid');
                if (this.value.length > 0) {
                    this.classList.add('is-valid');
                }
            }
        });
    });
    
    // Phone number formatting
    const phoneFields = document.querySelectorAll('input[type="tel"]');
    phoneFields.forEach(function(field) {
        field.addEventListener('input', function() {
            this.value = formatPhoneNumber(this.value);
        });
    });
}

/**
 * Initialize auto-dismiss alerts
 */
function initializeAlerts() {
    const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
    alerts.forEach(function(alert) {
        // Auto-dismiss after 5 seconds unless it's an error
        if (!alert.classList.contains('alert-danger')) {
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        }
    });
}

/**
 * Initialize smooth scrolling for anchor links
 */
function initializeSmoothScrolling() {
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                e.preventDefault();
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

/**
 * Initialize loading states for forms
 */
function initializeLoadingStates() {
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processando...';
                submitBtn.disabled = true;
                
                // Re-enable after 10 seconds as failsafe
                setTimeout(function() {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 10000);
            }
        });
    });
}

/**
 * Initialize confirmation dialogs for dangerous actions
 */
function initializeConfirmationDialogs() {
    const dangerousLinks = document.querySelectorAll('[data-confirm]');
    dangerousLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            const message = this.getAttribute('data-confirm') || 'Tem certeza?';
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });
}

/**
 * Initialize character counters for text areas
 */
function initializeCharacterCounters() {
    const textareas = document.querySelectorAll('textarea[data-max-length]');
    textareas.forEach(function(textarea) {
        const maxLength = parseInt(textarea.getAttribute('data-max-length'));
        const counter = document.createElement('div');
        counter.className = 'form-text text-end';
        counter.innerHTML = `0/${maxLength} caracteres`;
        textarea.parentNode.appendChild(counter);
        
        textarea.addEventListener('input', function() {
            const currentLength = this.value.length;
            counter.innerHTML = `${currentLength}/${maxLength} caracteres`;
            
            if (currentLength > maxLength * 0.9) {
                counter.classList.add('text-warning');
            } else {
                counter.classList.remove('text-warning');
            }
            
            if (currentLength > maxLength) {
                counter.classList.add('text-danger');
                counter.classList.remove('text-warning');
            } else {
                counter.classList.remove('text-danger');
            }
        });
    });
}

/**
 * Initialize AJAX forms for better UX
 */
function initializeAjaxForms() {
    const ajaxForms = document.querySelectorAll('form[data-ajax="true"]');
    ajaxForms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn ? submitBtn.innerHTML : '';
            
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enviando...';
                submitBtn.disabled = true;
            }
            
            fetch(this.action, {
                method: this.method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Sucesso!', data.message, 'success');
                    if (data.redirect) {
                        setTimeout(() => window.location.href = data.redirect, 1500);
                    }
                } else {
                    showNotification('Erro!', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Erro!', 'Ocorreu um erro inesperado.', 'error');
            })
            .finally(() => {
                if (submitBtn) {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });
        });
    });
}

/**
 * Utility Functions
 */

/**
 * Validate email format
 */
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

/**
 * Format phone number
 */
function formatPhoneNumber(phone) {
    const cleaned = phone.replace(/\D/g, '');
    const match = cleaned.match(/^(\d{2})(\d{4,5})(\d{4})$/);
    
    if (match) {
        return `(${match[1]}) ${match[2]}-${match[3]}`;
    }
    
    return phone;
}

/**
 * Show notification toast
 */
function showNotification(title, message, type = 'info') {
    // Create toast container if it doesn't exist
    let toastContainer = document.querySelector('.toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
        document.body.appendChild(toastContainer);
    }
    
    // Create toast
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type === 'error' ? 'danger' : type} border-0`;
    toast.setAttribute('role', 'alert');
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <strong>${title}</strong><br>${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    
    toastContainer.appendChild(toast);
    
    // Show toast
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    
    // Remove from DOM after hiding
    toast.addEventListener('hidden.bs.toast', function() {
        this.remove();
    });
}

/**
 * Debounce function for performance
 */
function debounce(func, wait, immediate) {
    let timeout;
    return function executedFunction() {
        const context = this;
        const args = arguments;
        const later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

/**
 * Local Storage helpers
 */
const Storage = {
    set: function(key, value) {
        try {
            localStorage.setItem(key, JSON.stringify(value));
            return true;
        } catch (e) {
            console.error('Failed to save to localStorage:', e);
            return false;
        }
    },
    
    get: function(key, defaultValue = null) {
        try {
            const item = localStorage.getItem(key);
            return item ? JSON.parse(item) : defaultValue;
        } catch (e) {
            console.error('Failed to read from localStorage:', e);
            return defaultValue;
        }
    },
    
    remove: function(key) {
        try {
            localStorage.removeItem(key);
            return true;
        } catch (e) {
            console.error('Failed to remove from localStorage:', e);
            return false;
        }
    }
};

/**
 * Theme switcher (if implemented)
 */
function toggleTheme() {
    const currentTheme = Storage.get('theme', 'light');
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    
    document.documentElement.setAttribute('data-theme', newTheme);
    Storage.set('theme', newTheme);
    
    // Update theme toggle button if exists
    const themeToggle = document.querySelector('.theme-toggle');
    if (themeToggle) {
        themeToggle.innerHTML = newTheme === 'light' ? 
            '<i class="fas fa-moon"></i>' : 
            '<i class="fas fa-sun"></i>';
    }
}

// Load saved theme on page load
const savedTheme = Storage.get('theme', 'light');
document.documentElement.setAttribute('data-theme', savedTheme);

// Export functions for global use
window.showNotification = showNotification;
window.toggleTheme = toggleTheme;
window.Storage = Storage;