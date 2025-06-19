'use client'

import { useEffect, useState } from 'react';

export default function ApiTest() {
  const [data, setData] = useState(null);
  const [error, setError] = useState(null);

  useEffect(() => {
    fetch('http://localhost:8080/api/ping')
      .then(res => res.json())
      .then(json => setData(json.message))
      .catch(err => setError(err.message));
  }, []); // run only once on mount

  if (error) return <div>Error: {error}</div>;
  if (!data) return <div>Loading...</div>;

  return <div>API says: {data}</div>;
}
