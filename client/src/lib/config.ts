// API Configuration
export const API_CONFIG = {
  baseUrl: process.env.NEXT_PUBLIC_API_URL,
  endpoints: {
    test: '/api/test',
    health: '/health',
    user: '/api/user',
    data: '/api/data',
  }
};

// Helper function to build API URLs
export const buildApiUrl = (endpoint: string): string => {
  return `${API_CONFIG.baseUrl}${endpoint}`;
}; 