using System.Collections;
using TMPro;
using UnityEngine;
using UnityEngine.SceneManagement;

public class LoginManager : MonoBehaviour
{
    [Header("Login")]
    [SerializeField] TMP_InputField Log_Email;
    [SerializeField] TMP_InputField Log_Password;
    [SerializeField] TextMeshProUGUI ErrorText;

    private void Start()
    {
        if (ErrorText != null)
        {
            ErrorText.text = "";
        }
    }

    public void OnLoginPressed()
    {
        if (ErrorText != null)
        {
            ErrorText.text = "";
        }

        if (string.IsNullOrWhiteSpace(Log_Email.text) || !IsValidEmail(Log_Email.text))
        {
            ShowError("Please enter a valid email address!");
            return;
        }

        if (string.IsNullOrWhiteSpace(Log_Password.text) || Log_Password.text.Length < 8)
        {
            ShowError("Password must be at least 8 characters!");
            return;
        }

        StartCoroutine(LoginUserCoroutine(Log_Email.text, Log_Password.text));
    }

    private IEnumerator LoginUserCoroutine(string email, string password)
    {
        yield return StartCoroutine(DB_Manager.LoginUser(email, password, (success, username) =>
        {
            if (success)
            {
                Debug.Log($"Successfully logged in as: {username}");
                SceneManager.LoadScene(3); // Make sure this scene index is correct for your main scene
            }
            else
            {
                ShowError("Invalid email or password!");
            }
        }));
    }

    private void ShowError(string message)
    {
        if (ErrorText != null)
        {
            ErrorText.text = message;
        }
        Debug.LogError(message);
    }

    private bool IsValidEmail(string email)
    {
        try
        {
            var addr = new System.Net.Mail.MailAddress(email);
            return addr.Address == email;
        }
        catch
        {
            return false;
        }
    }
}
