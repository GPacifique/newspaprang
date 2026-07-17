import React from 'react';

/**
 * STL wordmark logo. Renders as an inline SVG so it inherits color via
 * `currentColor` and scales cleanly at any size.
 *
 * Usage:
 *   <ApplicationLogo className="h-9 w-auto text-[#14171F]" />
 *   <ApplicationLogo className="h-9 w-auto text-white" />
 */
export default function ApplicationLogo({ className = 'h-9 w-auto', ...props }) {
    return (
        <svg
            viewBox="0 0 140 40"
            xmlns="http://www.w3.org/2000/svg"
            role="img"
            aria-label="STL — Sharp Tech Learners"
            className={className}
            {...props}
        >
            <title>STL</title>
            <rect x="0" y="0" width="40" height="40" rx="6" fill="currentColor" />
            <text
                x="20"
                y="27"
                textAnchor="middle"
                fontFamily="ui-sans-serif, system-ui, sans-serif"
                fontWeight="700"
                fontSize="18"
                fill="var(--stl-mark-fg, #FFFFFF)"
            >
                S
            </text>
            <text
                x="52"
                y="27"
                fontFamily="ui-sans-serif, system-ui, sans-serif"
                fontWeight="700"
                fontSize="20"
                letterSpacing="0.5"
                fill="currentColor"
            >
                STL
            </text>
        </svg>
    );
}