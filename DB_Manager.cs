using System.Collections;
using UnityEngine;
using UnityEngine.Networking;
using System.Text;
using System;

public class DB_Manager : MonoBehaviour
{
    private readonly static string API_URL = "http://localhost:8000/api"; // Default Laravel development server URL
    private static string authToken;

    [Serializable]
    private class LoginResponse
    {
        public string token;
        public UserData user;
    }

    [Serializable]
    public class UserData
    {
        public int id;
        public string name;
        public string email;
        public string bio;
        public string image_url;
    }

    [Serializable]
    private class RegisterRequest
    {
        public string name;
        public string email;
        public string password;
        public string password_confirmation;
    }

    [Serializable]
    private class LoginRequest
    {
        public string email;
        public string password;
    }

    public static string GetAuthToken()
    {
        return authToken;
    }

    public static IEnumerator RegisterUser(string email, string username, string password, System.Action<bool, string> callback)
    {
        string url = $"{API_URL}/register";

        var registerData = new RegisterRequest
        {
            name = username,
            email = email,
            password = password,
            password_confirmation = password
        };

        string jsonData = JsonUtility.ToJson(registerData);
        yield return SendPostRequest(url, jsonData, (success, response) =>
        {
            if (success)
            {
                try
                {
                    var loginResponse = JsonUtility.FromJson<LoginResponse>(response);
                    authToken = loginResponse.token;
                    callback(true, loginResponse.user.name);
                }
                catch (Exception e)
                {
                    Debug.LogError($"Failed to parse registration response: {e.Message}");
                    callback(false, "Registration failed: Invalid response format");
                }
            }
            else
            {
                callback(false, response);
            }
        });
    }

    public static IEnumerator LoginUser(string email, string password, System.Action<bool, string> callback)
    {
        string url = $"{API_URL}/login";

        var loginData = new LoginRequest
        {
            email = email,
            password = password
        };

        string jsonData = JsonUtility.ToJson(loginData);
        yield return SendPostRequest(url, jsonData, (success, response) =>
        {
            if (success)
            {
                try
                {
                    var loginResponse = JsonUtility.FromJson<LoginResponse>(response);
                    authToken = loginResponse.token;
                    callback(true, loginResponse.user.name);
                }
                catch (Exception e)
                {
                    Debug.LogError($"Failed to parse login response: {e.Message}");
                    callback(false, "Login failed: Invalid response format");
                }
            }
            else
            {
                callback(false, response);
            }
        });
    }

    public static IEnumerator GetUserData(System.Action<bool, UserData> callback)
    {
        if (string.IsNullOrEmpty(authToken))
        {
            callback(false, null);
            yield break;
        }

        string url = $"{API_URL}/export/user-data";
        yield return SendGetRequest(url, (success, response) =>
        {
            if (success)
            {
                try
                {
                    var userData = JsonUtility.FromJson<UserData>(response);
                    callback(true, userData);
                }
                catch (Exception e)
                {
                    Debug.LogError($"Failed to parse user data: {e.Message}");
                    callback(false, null);
                }
            }
            else
            {
                callback(false, null);
            }
        });
    }

    private static IEnumerator SendPostRequest(string url, string jsonData, System.Action<bool, string> callback)
    {
        using (UnityWebRequest req = new UnityWebRequest(url, "POST"))
        {
            byte[] bodyRaw = Encoding.UTF8.GetBytes(jsonData);
            req.uploadHandler = new UploadHandlerRaw(bodyRaw);
            req.downloadHandler = new DownloadHandlerBuffer();
            req.SetRequestHeader("Content-Type", "application/json");
            
            if (!string.IsNullOrEmpty(authToken))
            {
                req.SetRequestHeader("Authorization", $"Bearer {authToken}");
            }

            yield return req.SendWebRequest();

            if (req.result == UnityWebRequest.Result.Success)
            {
                string jsonResponse = req.downloadHandler.text;
                Debug.Log($"Response from {url}: {jsonResponse}");
                callback(true, jsonResponse);
            }
            else
            {
                Debug.LogError($"Error from {url}: {req.error}");
                callback(false, req.error);
            }
        }
    }

    private static IEnumerator SendGetRequest(string url, System.Action<bool, string> callback)
    {
        using (UnityWebRequest req = UnityWebRequest.Get(url))
        {
            if (!string.IsNullOrEmpty(authToken))
            {
                req.SetRequestHeader("Authorization", $"Bearer {authToken}");
            }

            yield return req.SendWebRequest();

            if (req.result == UnityWebRequest.Result.Success)
            {
                string jsonResponse = req.downloadHandler.text;
                Debug.Log($"Response from {url}: {jsonResponse}");
                callback(true, jsonResponse);
            }
            else
            {
                Debug.LogError($"Error from {url}: {req.error}");
                callback(false, req.error);
            }
        }
    }
}
